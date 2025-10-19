<?php
// File untuk memproses upload gambar

// Cek apakah ada file yang diupload
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['photo'];

    // Validasi tipe file
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp', 'image/svg'];
    if (!in_array($file['type'], $allowedTypes)) {
        $result = [
            'success' => false,
            'message' => 'Tipe file tidak diperbolehkan. Hanya JPG, JPEG, PNG, WEBP, atau SVG yang diterima.'
        ];
    } else {
        // Validasi ukuran file (maksimal 2MB)
        $maxSize = 2 * 1024 * 1024; // 2MB
        if ($file['size'] > $maxSize) {
            $result = [
                'success' => false,
                'message' => 'Ukuran file terlalu besar. Maksimal 2MB.'
            ];
        } else {
            // Buat nama file unik
            $fileName = time() . '_' . basename($file['name']);
            $uploadDir = __DIR__ . '/../storage/app/public/galery/';

            // Pastikan folder ada
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Pindahkan file ke folder tujuan
            $destination = $uploadDir . $fileName;
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                $result = [
                    'success' => true,
                    'message' => 'File berhasil diupload: ' . $fileName,
                    'path' => '/storage/galery/' . $fileName
                ];
            } else {
                $result = [
                    'success' => false,
                    'message' => 'Gagal mengupload file.'
                ];
            }
        }
    }
} else {
    $result = [
        'success' => false,
        'message' => 'Tidak ada file yang diupload atau terjadi error.'
    ];
}

// Tampilkan hasil
header('Content-Type: application/json');
echo json_encode($result);
?>