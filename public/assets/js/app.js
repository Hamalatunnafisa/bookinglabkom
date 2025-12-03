/* assets/js/app.js - demo behaviours */
(function () {
    // load sample data first time
    const sampleUsers = [
        { name: 'Alvia Tussaadah', username: 'alvia', password: '1234', role: 'user' },
        { name: 'Admin Lab', username: 'admin', password: 'admin123', role: 'admin' }
    ];
    if (!localStorage.getItem('bl_users')) localStorage.setItem('bl_users', JSON.stringify(sampleUsers));

    if (!localStorage.getItem('bl_bookings')) {
        const s = [
            { id: 'BK1', nama: 'Alvia T', kelas: 'INF-A', nim: '244110601091', nohp: '0812', lab: 'Lab Komputer 1', tanggal: new Date().toISOString().slice(0, 10), jam: '09:00', keperluan: 'Praktikum', status: 'approved', kode: 'abcd1234' },
            { id: 'BK2', nama: 'Budi', kelas: 'INF-B', nim: '244110601102', nohp: '0813', lab: 'Lab Komputer 2', tanggal: new Date().toISOString().slice(0, 10), jam: '13:00', keperluan: 'Ujian', status: 'pending', kode: 'efgh5678' }
        ];
        localStorage.setItem('bl_bookings', JSON.stringify(s));
    }

    // header welcome
    document.addEventListener('DOMContentLoaded', function () {
        try {
            const session = JSON.parse(localStorage.getItem('bl_session') || 'null');
            const welcome = document.getElementById('header-welcome');
            if (welcome) {
                if (session) welcome.innerText = 'Selamat datang, ' + (session.name || session.username);
                else welcome.innerHTML = '<a href="login.php" style="color:#fff;text-decoration:underline">Silakan login</a>';
            }

            // dashboard stats
            const bookings = JSON.parse(localStorage.getItem('bl_bookings') || '[]');
            const users = JSON.parse(localStorage.getItem('bl_users') || '[]');
            const admins = users.filter(u => u.role === 'admin').length;
            const reports = 3; // demo
            const totalBookings = bookings.length;
            const today = new Date().toISOString().slice(0, 10);
            const todayCount = bookings.filter(b => b.tanggal === today).length;
            const available = 4 - todayCount; // assuming 4 labs

            if (document.getElementById('stat-bookings')) document.getElementById('stat-bookings').innerText = todayCount;
            if (document.getElementById('stat-available')) document.getElementById('stat-available').innerText = Math.max(0, available);
            if (document.getElementById('stat-users')) document.getElementById('stat-users').innerText = users.length;
            if (document.getElementById('stat-admins')) document.getElementById('stat-admins').innerText = admins;
            if (document.getElementById('stat-history')) document.getElementById('stat-history').innerText = totalBookings;
            if (document.getElementById('stat-reports')) document.getElementById('stat-reports').innerText = reports;
        } catch (e) { console.warn(e); }
    });
})();
