class Ajax {
    constructor() {
        /* Sesuaikan URL API dengan alamat backend */
        this.url_api = 'http://localhost/webservice/part_2/backend/';

        /* Sesuaikan API KEy dengan API Key yang terdaftar di backend */
        //this.api_key = 'e41d1f4ac632e4adf91ebf087a487ba4';

        this.ContainerLoading = null;
    }

    sendRequest(method, url_target, data) {
        var url = this.url_api + url_target;
        //var api_key = this.api_key;
        const ContainerLoading = this.ContainerLoading;
        const ShowLoading = this.ShowLoading();
        return new Promise(function(resolve, reject) {
            /* new instance dari object XMLHttpRequest */
            var http = new XMLHttpRequest();

            /* Membuka koneksi dengan backend server */
            http.open(method, url);

            /* Set header */
            http.setRequestHeader("Cache-Control", "no-cache");
            //http.setRequestHeader("api-key", api_key);

            /* Event ketika memulai memuat data dari backend */
            http.onloadstart = function() {
                if(ContainerLoading != null) {
                    ContainerLoading.innerHTML = '';
                    ContainerLoading.appendChild(ShowLoading);
                }
            }

            /* Event ketika berhasil mendapatlan data dari backend */
            http.onload = function() {
                if (http.readyState == 4 && http.status == 200) {
                    var response = http.responseText;
                    resolve(response);
                }
            }

            /* Event ketika gagal melakukan koneksi ke backend */
            http.onerror = reject;

            /* Kirim permintaan (request) data ke backend */
            http.send(data);
        });
    }

    /* Method untuk menampilkan gambar loading 
    ketika request dari backend blm selesai */
    ShowLoading() {
        var divElement = document.createElement("div");
        divElement.style.textAlign = "center";
        divElement.style.padding = "30px";
        divElement.style.height = "100%";

        var imgElement = document.createElement("img");
        imgElement.src = "loading.gif";

        divElement.appendChild(imgElement);

        return divElement;
    }
}
