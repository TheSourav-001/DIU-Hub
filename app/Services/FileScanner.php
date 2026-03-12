<?php

namespace App\Services;

class FileScanner
{
    /**
     * Allowed MIME types and their expected extensions.
     */
    protected static array $allowedMimes = [
        'application/pdf'    => ['pdf'],
        'image/jpeg'         => ['jpg', 'jpeg'],
        'image/png'          => ['png'],
        'image/gif'          => ['gif'],
        'application/msword' => ['doc'],
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => ['docx'],
        'application/vnd.ms-powerpoint' => ['ppt'],
        'application/vnd.openxmlformats-officedocument.presentationml.presentation' => ['pptx'],
        'application/vnd.ms-excel' => ['xls'],
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => ['xlsx'],
        'text/plain'         => ['txt'],
        'application/zip'    => ['zip'],
    ];

    /**
     * Dangerous file signatures / patterns to detect embedded malware.
     */
    protected static array $dangerousPatterns = [
        '/<\?php/i',                    // Embedded PHP code
        '/<\?=/i',                      // PHP short echo tags
        '/<script\b[^>]*>/i',          // JavaScript injection
        '/eval\s*\(/i',                 // eval() calls
        '/base64_decode\s*\(/i',        // Base64 decode (obfuscation)
        '/exec\s*\(/i',                 // exec() system calls
        '/system\s*\(/i',               // system() calls
        '/shell_exec\s*\(/i',           // shell_exec() calls
        '/passthru\s*\(/i',             // passthru() calls
        '/preg_replace.*\/e/i',         // Code execution via regex
        '/\bpopen\s*\(/i',             // Process open
        '/\bproc_open\s*\(/i',         // Process open
    ];

    /**
     * Dangerous file extensions that should never be uploaded.
     */
    protected static array $blockedExtensions = [
        'php', 'php3', 'php4', 'php5', 'phtml', 'phar',
        'exe', 'bat', 'cmd', 'sh', 'bash', 'com', 'vbs',
        'js', 'jsp', 'asp', 'aspx', 'cgi', 'py', 'rb',
        'htaccess', 'htpasswd', 'ini', 'env', 'sql',
        'dll', 'so', 'msi', 'scr', 'reg', 'lnk',
    ];

    /**
     * Scan an uploaded file for threats.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return array{safe: bool, reason: string|null}
     */
    public static function scan($file): array
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $mimeType  = $file->getMimeType();
        $realPath  = $file->getRealPath();

        // 1. Block dangerous file extensions
        if (in_array($extension, self::$blockedExtensions)) {
            return ['safe' => false, 'reason' => "File type '.{$extension}' is not allowed for security reasons."];
        }

        // 2. Check for double extensions (e.g., malware.php.jpg)
        $originalName = $file->getClientOriginalName();
        $nameParts = explode('.', $originalName);
        if (count($nameParts) > 2) {
            foreach (array_slice($nameParts, 0, -1) as $part) {
                if (in_array(strtolower($part), self::$blockedExtensions)) {
                    return ['safe' => false, 'reason' => 'File contains a suspicious double extension.'];
                }
            }
        }

        // 3. Validate MIME type is in our allowed list
        $mimeAllowed = false;
        foreach (self::$allowedMimes as $mime => $extensions) {
            if ($mimeType === $mime && in_array($extension, $extensions)) {
                $mimeAllowed = true;
                break;
            }
        }
        if (!$mimeAllowed) {
            return ['safe' => false, 'reason' => "File type '{$extension}' with MIME '{$mimeType}' is not permitted."];
        }

        // 4. Check magic bytes match expected file type
        $header = file_get_contents($realPath, false, null, 0, 16);
        if ($header === false) {
            return ['safe' => false, 'reason' => 'Unable to read file for security scanning.'];
        }

        $magicBytesValid = self::validateMagicBytes($header, $extension);
        if (!$magicBytesValid) {
            return ['safe' => false, 'reason' => 'File content does not match its extension. Possible file spoofing detected.'];
        }

        // 5. Scan file content for malicious patterns (for text-readable files)
        if ($file->getSize() < 10 * 1024 * 1024) { // Only scan files < 10MB
            $content = file_get_contents($realPath);
            if ($content !== false) {
                foreach (self::$dangerousPatterns as $pattern) {
                    if (preg_match($pattern, $content)) {
                        return ['safe' => false, 'reason' => 'File contains potentially malicious code and has been blocked.'];
                    }
                }
            }
        }

        // 6. File size sanity check (max 50MB)
        if ($file->getSize() > 50 * 1024 * 1024) {
            return ['safe' => false, 'reason' => 'File exceeds the maximum allowed size of 50MB.'];
        }

        return ['safe' => true, 'reason' => null];
    }

    /**
     * Validate file magic bytes match the expected extension.
     */
    protected static function validateMagicBytes(string $header, string $extension): bool
    {
        $hex = bin2hex(substr($header, 0, 8));

        return match ($extension) {
            'pdf'          => str_starts_with($header, '%PDF'),
            'jpg', 'jpeg'  => str_starts_with($hex, 'ffd8ff'),
            'png'          => str_starts_with($hex, '89504e47'),
            'gif'          => str_starts_with($header, 'GIF87a') || str_starts_with($header, 'GIF89a'),
            'zip', 'docx', 'pptx', 'xlsx' => str_starts_with($hex, '504b0304'),
            'doc', 'xls', 'ppt'           => str_starts_with($hex, 'd0cf11e0'),
            'txt'          => true, // Plain text has no magic bytes
            default        => true,
        };
    }
}
