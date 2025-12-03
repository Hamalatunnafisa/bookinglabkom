<?php
class BookingModel {
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createBooking($data) {
        $sql = "INSERT INTO booking (nama, kelas, nim, nohp, jam, lab, tanggal, qrcode)
                VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['nama'], $data['kelas'], $data['nim'], $data['nohp'],
            $data['jam'], $data['lab'], $data['tanggal'], $data['qrcode']
        ]);
    }

    public function getTodayBooking() {
        $stmt = $this->db->prepare("SELECT * FROM booking WHERE tanggal = CURDATE()");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getRiwayat($nim) {
        $stmt = $this->db->prepare("SELECT * FROM booking WHERE nim = ?");
        $stmt->execute([$nim]);
        return $stmt->fetchAll();
    }
}
