<template>
    <div>
        <h1>Chat</h1>
        <div v-show="tampil">
            <input type="text" name="" id="" placeholder="Isikan Nama Anda" v-model="pesan.nama">
            <button @click="namae()">Simpan</button>
        </div>
        <div class="chat" v-show="!tampil">
        <div class="konten">
            <ul>
                <li v-for="pesan in pesan" v-bind:key="pesan.id">
                    <p>{{pesan.pesan}}</p>
                    <small>{{pesan.nama}}</small>
                </li>
            </ul>
        </div>
        <input type="text" name="nama" v-model="pesan.nama" readonly>
        <input type="text" name="pesan" v-model="pesan.pesan">
        <button @click="kirimPesan()">Kirim</button>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            tampil : true,
            pesan : {nama : '',pesan:''}
        }
    },
    created:function(){
        this.tampilPesan();
    },
    methods:{
        kirimPesan(){
            console.log(this.pesan);
            var vm = this;
            var dPesan = vm.pesan;
            axios.post('/api/chat',dPesan).then(function(response){
                console.log("Simpan");
            });
            this.tampilPesan();
        },
        namae(){
            // this.nama = this.nama;
            this.tampil = false;
            console.log(this.pesan.nama);
        },
        tampilPesan(){
            var vm = this;
            axios.get('/api/chat').then(function(response){
                console.log(response.data.pesan);
                vm.pesan = response.data.pesan;
            });
        }
    }
}
</script>

<style>
.konten{
    overflow: scroll;
    height: 300px;
    width: 50%;
    background-color: white;
    color: black;
}
</style>

