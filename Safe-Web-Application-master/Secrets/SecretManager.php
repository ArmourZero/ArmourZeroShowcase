<?php
final class SecretManager
{
    private const STORAGE_FILE = __DIR__ . '/../../.secret_store.json';
    private $data;

    public function __construct()
    {
        if (file_exists(self::STORAGE_FILE)) {
            $json = file_get_contents(self::STORAGE_FILE);
            $this->data = json_decode($json, true) ?: [];
        } else {
            $this->data = [
                'api_key_hash'   => password_hash('DEMO_INITIAL_KEY_DO_NOT_USE', PASSWORD_ARGON2ID),
                // 'masked_display' => '',
                'rotated'        => false,
                'last_rotated_at'=> null,
            ];
            $this->persist();
        }
    }

    // return masked UI string (never reveal plaintext)
    // public function getMasked(): string
    // {
    //     return $this->data['masked_display'] ?? '***';
    // }

    // return the stored hash (one-way) — safe to reveal in a demo
    public function getHash(): string
    {
        return $this->data['api_key_hash'] ?? '';
    }

    public function verify(string $candidate): bool
    {
        return password_verify($candidate, $this->data['api_key_hash']);
    }

    public function rotateAndHide(): void
    {
        $newKey = bin2hex(random_bytes(16));
        $this->data['api_key_hash']   = password_hash($newKey, PASSWORD_ARGON2ID);
        // $this->data['masked_display'] = '[SECURED: value hidden]';
        $this->data['rotated']        = true;
        $this->data['last_rotated_at']= time();
        $this->persist();
    }

    public function getMeta(): array
    {
        return [
            'rotated' => (bool)($this->data['rotated'] ?? false),
            'last_rotated_at' => isset($this->data['last_rotated_at']) ? (int)$this->data['last_rotated_at'] : null,
        ];
    }

    private function persist(): void
    {
        $dataToWrite = json_encode($this->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        file_put_contents(self::STORAGE_FILE, $dataToWrite, LOCK_EX);
        @chmod(self::STORAGE_FILE, 0600);
    }
}
