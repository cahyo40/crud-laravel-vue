<template>
    <div>
        <h1>{{nama}}</h1>
        <table border="1px" cellpadding="2px" class="table">
            <thead>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Email</th>
                <th>Hapus</th>
                <th>Ubah</th>
            </thead>
            <tbody>
                <tr v-for="data in datas.data" v-bind:key="data.id">
                    <td>{{data.nama}}</td>
                    <td>{{data.alamat}}</td>
                    <td>{{data.telepon}}</td>
                    <td>{{data.email}}</td>
                    <td><button @click="hapus(data.id)">Hapus</button></td>
                    <td><button @click="pilih(data.id)" type="submit">Ubah</button></td>
                </tr>
            </tbody>
        </table>
        <br>
            <input type="text" placeholder="nama" name="nama" v-model="datas.nama">
            <input type="text" placeholder="alamat" name="alamat" v-model="datas.alamat">
            <input type="text" placeholder="telepon" name="telepon"  v-model="datas.telepon">
            <input type="text" placeholder="email" name="email" v-model="datas.email">
            <div v-show="!editable">
                <button type="submit" @click="tambah()">Tambah</button>
            </div>
            <div v-show="editable">
                <button @click="edit(id_anggota)" type="submit">Edit</button>
            </div>
    </div>
</template>
<script>
export default{
    data(){
        return{
            nama : 'Data Anggota',
            datas : [{nama:'',alamat:'',telepon:'',email:''}],
            editable : false,
            id_anggota : ''
        }
    },
    created:function(){
        this.tampil();
    },
    methods:{
        tampil(){
            var vm = this;
            axios.get('/api/data').then(function(response){
                vm.datas = response.data.data;
            });
        },
        tambah(){
            var vm = this;
            var tambahData = this.datas;
            axios.post('/api/data',tambahData).then(function(response){
                alert("berhasil");
            });
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
<style>
input[type="text"]{
    width: 200px;
    height: 25px;
    font-size: 15px;
    border: 1px solid black;
    background-color: bisque;
    font-family: 'Times New Roman', Times, serif;
    display: block;
    margin: 15px;
}
</style>

