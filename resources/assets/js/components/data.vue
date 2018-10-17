<template>
    <div>
        <h1>{{nama}}</h1>
        <button @click="form = !form" v-show="!form">Tampilkan Form</button>
        <div v-show="form">
        <button @click="form = false" v-show="true">Sembunyikan Form</button>
            <h3>Form Tambah Anggota</h3>
            <input type="text" class="form-control" placeholder="nama" name="nama" v-model="datas.nama"><br>
            <input type="text" class="form-control" placeholder="alamat" name="alamat" v-model="datas.alamat"><br>
            <input type="text" class="form-control" placeholder="telepon" name="telepon"  v-model="datas.telepon"><br>
            <input type="text" class="form-control" placeholder="email" name="email" v-model="datas.email"><br>
            <div v-show="!editable">
                <button type="submit" @click="tambah()">Tambah</button>
            </div>
            <div v-show="editable">
                <button @click="edit(id_anggota)" type="submit">Edit</button>
            </div>
            <br>

        </div>
        <br><br>
        <div style="margin-bottom:50px;margin-left:100px;margin-right:100px;padding-bottom:10px;">
        <div class="pull-left">
            <button @click="sebelum()"><span class="glyphicon glyphicon-arrow-left"></span></button>
            <span>Halaman : {{halaman}} dari {{akhir}}</span>
            <button @click="berikut()"><span class="glyphicon glyphicon-arrow-right"></span></button>
            <span>Banyak data : {{banyak}}</span>
        </div>
        <div class="pull-right">
            <input v-on:keyup="tampil()" class="form-control" type="text" placeholder="search" v-model="search">
        </div>
        </div>
        <br>

        <table class="table table-bordered table-hover">
            <thead >
                <tr class="danger">
                <th style="width:40%">Nama</th>
                <th style="width:20%">Alamat</th>
                <th style="width:20%">Telepon</th>
                <th style="width:10%">Email</th>
                <th style="width:5%"></th>
                <th style="width:5%"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="data in datas.data" v-bind:key="data.id">
                    <td>{{data.nama}}</td>
                    <td>{{data.alamat}}</td>
                    <td>{{data.telepon}}</td>
                    <td>{{data.email}}</td>
                    <td><button class="btn btn-danger" @click="hapus(data.id)"><span class="glyphicon glyphicon-trash"></span></button></td>
                    <td><button class="btn btn-warning" @click="pilih(data.id)" type="submit"><span class="glyphicon glyphicon-cog"></span></button></td>
                </tr>
                <tr v-if="banyak == 0">
                    <td colspan="5" align="center">Tidak ada data</td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="danger">
                <th style="width:40%">Nama</th>
                <th style="width:20%">Alamat</th>
                <th style="width:20%">Telepon</th>
                <th style="width:10%">Email</th>
                <th style="width:5%"></th>
                <th style="width:5%"></th>
                </tr>
            </tfoot>
        </table>

        <br>

    </div>
</template>
<script>
export default{
    data(){
        return{
            nama : 'Data Anggota',
            datas : {nama:'',alamat:'',telepon:'',email:''},
            editable : false,
            id_anggota : '',
            halaman : 1,
            url : '/api/data',
            akhir: null,
            search : '',
            page :15,
            banyak : null,
            form :false,
        }
    },
    created:function(){
        this.tampil();
    },
    methods:{
        sebelum(){
            this.halaman = this.halaman - 1;
            if(this.halaman < 1 ){
                alert('jangan diklik lagi');
                this.halaman = 1;
            }else{
                this.tampil();
            }
        },
        berikut(){
            this.halaman = (this.halaman - (-1));
            if(this.halaman > this.akhir){
                alert('mentok bung');
                this.halaman = this.akhir;
            }else{
                this.tampil();
            }
        },
        tampil(){
            var vm = this;
            // axios.get(vm.url+'?page='+vm.halaman+'&search='+vm.search).then(function(response){
            axios.get(vm.url+'/'+vm.search+'?page='+vm.halaman).then(function(response){
                vm.datas = response.data.data;
                vm.akhir = response.data.data.last_page;
                vm.banyak = response.data.data.total;
                console.log(response.data.data);
            });
        },
        tambah(){
            var vm = this;
            var tambahData = this.datas;
            axios.post('/api/data',tambahData).then(function(response){
                alert("berhasil");
            });
            this.form = false;
            this.tampil();
        },
        hapus(id){
            if(confirm("Apa benar akan dihapus ??")){
                axios.delete('/api/data/'+id).then(function(response){
            });
                this.tampil();
            }else{
                this.tampil();
            }

        },
        pilih(id){
            var vm = this;
            vm.editable = true;
            axios.get('/api/data/'+id+'/pilih').then(function(response){
                vm.datas.nama = response.data.nama;
                vm.datas.alamat = response.data.alamat;
                vm.datas.telepon = response.data.telepon;
                vm.datas.email = response.data.email;
                vm.id_anggota = response.data.id;
                console.log(vm.datas.nama);
            });
        },

        edit(id){
            var vm = this;
            var tambahData = vm.datas;
            axios.post('/api/data/'+id+'/edit',tambahData).then(function(response){
                alert("berhasil");
            });
            this.tampil();
            vm.editable = false;
        }
    }
}
</script>

