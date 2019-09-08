<template>
    <div class="row">
        <div class="col-md-4 p-4">
            <div class="card">
                <div class="card-body">
                    <h5>Register</h5>
                    <select v-model="register" class="form-control" id="register">
                        <option value="pembeli">Daftar Pembeli</option>
                        <option value="penjual">Daftar Penjual</option>
                    </select>
                </div>
            </div>
        </div>
        <div v-show="register === 'penjual'" class="col-md-8 p-4">
            <div class="card p-4">
                <div class="card-body">
                    <h3 class="text-center">Registrasi Pedagang</h3>
                    <form @submit.prevent="registerSeller" method="POST" action="">

                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input 
                                v-model="username"
                                class="form-control"
                                :class="{'is-invalid': get(this.error_data_seller, 'errors.username[0]', '')}"
                                type='text'
                                id="name"
                                placeholder="Username"
                                />
                            <div class='invalid-feedback'>
                                {{ get(this.error_data_seller, 'errors.username[0]', false) }}
                            </div>
                        </div>

                        <div class='form-group'>
                            <label for='password'> Password: </label>
                            <input
                                v-model='password'
                                class='form-control'
                                :class="{'is-invalid': get(this.error_data_seller, 'errors.password[0]', false)}"
                                type='password'
                                id='password'
                                placeholder='Password'>
                            <div class='invalid-feedback'>
                                 {{ get(this.error_data_seller, 'errors.password[0]', false) }}
                            </div>
                        </div>

                        <div class='form-group'>
                            <label for='password_confirmation'> Konfirmasi Password: </label>
                            <input
                                v-model='password_confirmation'
                                class='form-control'
                                :class="{'is-invalid': get(this.error_data_seller, 'errors.password_confirmation[0]', false)}"
                                type='password'
                                id='password_confirmation'
                                placeholder='Konfirmasi Password'>
                            <div class='invalid-feedback'>
                                 {{ get(this.error_data_seller, 'errors.password_confirmation[0]', false) }}
                            </div>
                        </div>

                        <div class='form-group'>
                            <label for='nama'> Nama: </label>
                            <input
                                v-model='nama'
                                class='form-control'
                                :class="{'is-invalid': get(this.error_data_seller, 'errors.nama[0]', false)}"
                                type='text'
                                id='nama'
                                placeholder='Nama'>
                            <div class='invalid-feedback'>
                                 {{ get(this.error_data_seller, 'errors.nama[0]', false) }}
                            </div>
                        </div>

                        <div class='form-group'>
                            <label for='nama_toko'> Nama Toko: </label>
                            <input
                                v-model='nama_toko'
                                class='form-control'
                                :class="{'is-invalid': get(this.error_data_seller, 'errors.nama_toko[0]', false)}"
                                type='text'
                                id='nama_toko'
                                placeholder='Nama Toko'>
                            <div class='invalid-feedback'>
                                 {{ get(this.error_data_seller, 'errors.nama_toko[0]', false) }}
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input 
                                v-model="email"
                                class="form-control"
                                :class="{'is-invalid': get(this.error_data_seller, 'errors.email[0]', '')}"
                                type='text'
                                id="name"
                                placeholder="E-mail"
                                />
                            <div class='invalid-feedback'>
                                {{ get(this.error_data_seller, 'errors.email[0]', false) }}
                            </div>
                        </div>

                        <div class='form-group'>
                            <label for='kota'> Kota: </label>
                            <input
                                v-model='kota'
                                class='form-control'
                                :class="{'is-invalid': get(this.error_data_seller, 'errors.kota[0]', false)}"
                                type='text'
                                id='kota'
                                placeholder='Kota'>
                            <div class='invalid-feedback'>
                                 {{ get(this.error_data_seller, 'errors.kota[0]', false) }}
                            </div>
                        </div>

                        <div class='form-group'>
                            <label for='alamat'> Alamat: </label>
                            <input
                                v-model='alamat'
                                class='form-control'
                                :class="{'is-invalid': get(this.error_data_seller, 'errors.alamat[0]', false)}"
                                type='text'
                                id='alamat'
                                placeholder='Alamat'>
                            <div class='invalid-feedback'>
                                 {{ get(this.error_data_seller, 'errors.alamat[0]', false) }}
                            </div>
                        </div>

                        <div class='form-group'>
                            <label for='no_telp'> No Telp: </label>
                            <input
                                v-model='no_telp'
                                class='form-control'
                                :class="{'is-invalid': get(this.error_data_seller, 'errors.no_telp[0]', false)}"
                                type='text'
                                id='no_telp'
                                placeholder='No Telp / Format Internasional {+628..}'>
                            <div class='invalid-feedback'>
                                 {{ get(this.error_data_seller, 'errors.no_telp[0]', false) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pasar">Pasar</label>
                            <select 
                                v-model="pasar_id" 
                                name="pasar_id" 
                                id="pasar" 
                                :class="{'is-invalid': get(this.error_data_seller, 'errors.foto_profil[0]', false)}"
                                class="form-control">
                                <option 
                                    :key="i"
                                    v-for="(market,i) in markets"
                                    :value="market.id">
                                    {{market.nama_pasar}}
                                    </option>
                            </select>
                            <div class='invalid-feedback'>
                                 {{ get(this.error_data_seller, 'errors.pasar_id[0]', false) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="foto_profil">Foto Profil</label>
                            <input 
                                ref="foto_profil"
                                :class="{'is-invalid': get(this.error_data_seller, 'errors.foto_profil[0]', false)}"
                                type="file"
                                id="foto_profil"
                                class="form-control-file">
                        </div>
                        <div class="text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div v-show="register === 'pembeli'" class="col-md-8 p-4">
            <div class="card p-4">
                <div class="card-body">
                    <h3 class="text-center">Registrasi Pembeli</h3>
                    <form @submit.prevent="registerBuyer" method="POST" action="">
                        <div class='form-group'>
                            <label for='username'> Username: </label>
                            <input
                                v-model='username'
                                class='form-control'
                                :class="{'is-invalid': get(this.error_data_buyer, 'errors.username[0]', false)}"
                                type='text'
                                id='username'
                                placeholder='Username'>
                            <div class='invalid-feedback'>
                                 {{ get(this.error_data_buyer, 'errors.username[0]', false) }}
                            </div>
                        </div>

                        <div class='form-group'>
                            <label for='password'> Password: </label>
                            <input
                                v-model='password'
                                class='form-control'
                                :class="{'is-invalid': get(this.error_data_buyer, 'errors.password[0]', false)}"
                                type='password'
                                id='password'
                                placeholder='Password'>
                            <div class='invalid-feedback'>
                                 {{ get(this.error_data_buyer, 'errors.password[0]', false) }}
                            </div>
                        </div>

                        <div class='form-group'>
                            <label for='password_confirmation'> Konfirmasi Password: </label>
                            <input
                                v-model='password_confirmation'
                                class='form-control'
                                :class="{'is-invalid': get(this.error_data_buyer, 'errors.password_confirmation[0]', false)}"
                                type='password'
                                id='password_confirmation'
                                placeholder='Konfirmasi Password'>
                            <div class='invalid-feedback'>
                                 {{ get(this.error_data_buyer, 'errors.password_confirmation[0]', false) }}
                            </div>
                        </div>

                       <div class='form-group'>
                            <label for='nama'> Nama: </label>
                            <input
                                v-model='nama'
                                class='form-control'
                                :class="{'is-invalid': get(this.error_data_buyer, 'errors.nama[0]', false)}"
                                type='text'
                                id='nama'
                                placeholder='Nama'>
                            <div class='invalid-feedback'>
                                 {{ get(this.error_data_buyer, 'errors.nama[0]', false) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input 
                                v-model="email"
                                class="form-control"
                                :class="{'is-invalid': get(this.error_data_buyer, 'errors.email[0]', '')}"
                                type='text'
                                id="name"
                                placeholder="E-mail"
                                />
                            <div class='invalid-feedback'>
                                {{ get(this.error_data_buyer, 'errors.email[0]', false) }}
                            </div>
                        </div>

                        <div class='form-group'>
                            <label for='kota'> Kota: </label>
                            <input
                                v-model='kota'
                                class='form-control'
                                :class="{'is-invalid': get(this.error_data_buyer, 'errors.kota[0]', false)}"
                                type='text'
                                id='kota'
                                placeholder='Kota'>
                            <div class='invalid-feedback'>
                                 {{ get(this.error_data_buyer, 'errors.kota[0]', false) }}
                            </div>
                        </div>

                        <div class='form-group'>
                            <label for='alamat'> Alamat: </label>
                            <input
                                v-model='alamat'
                                class='form-control'
                                :class="{'is-invalid': get(this.error_data_buyer, 'errors.alamat[0]', false)}"
                                type='text'
                                id='alamat'
                                placeholder='Alamat'>
                            <div class='invalid-feedback'>
                                 {{ get(this.error_data_buyer, 'errors.alamat[0]', false) }}
                            </div>
                        </div>

                        <div class='form-group'>
                            <label for='no_telp'> No Telp: </label>
                            <input
                                v-model='no_telp'
                                class='form-control'
                                :class="{'is-invalid': get(this.error_data_buyer, 'errors.no_telp[0]', false)}"
                                type='text'
                                id='no_telp'
                                placeholder='No Telp / Format Internasional'>
                            <div class='invalid-feedback'>
                                 {{ get(this.error_data_buyer, 'errors.no_telp[0]', false) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="foto_profil">Foto Profil</label>
                            <input 
                                :class="{'is-invalid': get(this.error_data_buyer, 'errors.foto_profil[0]', false)}"
                                type="file"
                                id="foto_profil"
                                class="form-control-file">
                        </div>

                        <div class="text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { get }  from 'lodash'
export default {
    props : [
        "markets", "register_seller", "register_customer", "csrf_token", "redirect_url"
    ],
    data() {
        return {
            register:"pembeli",
            username : "",
            password : "",
            password_confirmation : "",
            nama : "",
            email : "",
            alamat : "",
            kota : "",
            no_telp: "",
            pasar_id : this.markets[0].id,
            nama_toko : "",
            foto_profil : "",
            error_data_seller : null,
            error_data_buyer : null,
            multipartHeader : {headers : { 'Content-Type' : "multipart/form-data"}},
        }
    },

    computed : {
        sellerFormData(){
            return {
                username : this.username,
                password : this.password,
                password_confirmation : this.password_confirmation,
                nama : this.nama,
                email : this.email,
                alamat : this.alamat,
                kota : this.kota,
                no_telp : this.no_telp,
                nama_toko : this.nama_toko,
                pasar_id : this.pasar_id,
                foto_profil : this.foto_profil,
                _token : this.csrf_token
            }
        },
        buyerFormData()
        {
            return {
                username : this.username,
                password : this.password,
                password_confirmation : this.password_confirmation,
                nama : this.nama,
                email : this.email,
                alamat : this.alamat,
                kota : this.kota,
                no_telp : this.no_telp,
                foto_profil : this.foto_profil,
                _token : this.csrf_token
            }
        }
    },

    methods : {
        get : get,
        registerSeller(e){
            let formData = new FormData();
            let formKeys = Object.keys(this.sellerFormData);
            for(let i = 0 ; i < formKeys.length ; ++i){
                formData.append(formKeys[i],this.sellerFormData[formKeys[i]]);
            }
            
            if(this.$refs.foto_profil.files.length > 0){
                formData.append("foto_profil",this.$refs.foto_profil.files[0]);
            }
            
            axios.post(this.register_seller,formData,this.multipartHeader)
                .then(response => {
                    if (response.status == 200) {
                        window.location.replace(this.redirect_url);
                    }
                })
                .catch(error => {
                    this.error_data_seller = error.response.data;
                });
        },
        registerBuyer(e){
            let formData = new FormData();
            let formKeys = Object.keys(this.buyerFormData);
            for(let i = 0 ; i < formKeys.length ; ++i){
                formData.append(formKeys[i],this.sellerFormData[formKeys[i]]);
            }
            
            if(this.$refs.foto_profil.files.length > 0){
                formData.append("foto_profil",this.$refs.foto_profil.files[0]);
            }
            
            axios.post(this.register_customer,formData,this.multipartHeader)
                .then(response => {
                    if (response.status == 200) {
                        window.location.replace(this.redirect_url);
                    }
                })
                .catch(error => {
                    this.error_data_buyer = error.response.data;
                });
        }
    }
}
</script>