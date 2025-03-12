class Handle {
    constructor() {
        //Properti untuk meng-instansiasi class AJAX
        this.Service = null;

        this.counterNotifikasi = document.getElementById('counterNotifikasi');
        this.notifikasiDropdown = document.getElementById('notifikasiDropdown');
        this.notificationItems = document.getElementById('notificationItems');
    }
    inisialisasi() {
        /* Instansiasi class ajax */
        this.Service = new Ajax();

        // Memanggil setiap 2 detik
        setInterval(this.updateNotifikasi.bind(this), 2000); 
        
        this.notifikasiDropdown.addEventListener('click', function() {
            this.tampilkanPesan();
        }.bind(this));
    }
    updateNotifikasi() {
        // Request data element ke backend
        this.Service.sendRequest('get', 'notifikasi.php', null)
        .then(function(result){
            // Jika request berhasil, maka baca data element-nya
            this.parsingDataNotifikasi(result);
        }.bind(this))
        .catch(function(error){
            // Jika request gagal, maka tampilkan error-nya
            console.log(error);
        });
    }
    parsingDataNotifikasi(response) {
        /* Mengkonversi String ke array JSON */
        var dataJson = JSON.parse(response);
        var dataElement = dataJson.data;
        this.counterNotifikasi.innerHTML = dataElement;
    }
    tampilkanPesan() {
        this.Service.ContainerLoading = this.animasi_loading;
        // Request data element ke backend
        this.Service.sendRequest('get', 'tampil_pesan.php', null)
        .then(function(result){
            // Jika request berhasil, maka baca data element-nya
            this.parsingDataPesan(result);
        }.bind(this))
        .catch(function(error){
            // Jika request gagal, maka tampilkan error-nya
            console.log(error);
        });
    }
    parsingDataPesan(response) {
        /* Mengkonversi String ke array JSON */
        var dataJson = JSON.parse(response);
        var data = dataJson.data;
        
        if (data.length === 0) {
            this.notificationItems.innerHTML = '<a class="dropdown-item" href="#"><span class="small text-muted">Tidak ada pesan baru.</span></a>';
            return;
        }

        this.notificationItems.innerHTML = "";
        data.forEach(notif => {
            const item = document.createElement('a');
            item.classList.add('dropdown-item');
            item.href = "#"; // Bisa diganti dengan link ke detail notifikasi
            
            item.innerHTML = `
                <strong>${notif.nama_pengirim}</strong><br>
                <span class="small text-muted">${notif.isi_pesan}</span>
            `;

            this.notificationItems.appendChild(item);
        });
    }
}//end class

//Inisialisasi class Handle
window.addEventListener('load', () => {
    const handle = new Handle();
    handle.inisialisasi();
});
