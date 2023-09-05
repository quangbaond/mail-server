<template>
    <div class="container">
        <loading-component :active.sync="loading"></loading-component>
        <div class="row my-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Kiểm tra email</h3>
                    </div>
                    <div class="card-body">
                        <input v-model="email" type="text" class="form-control" placeholder="nhập email của bạn">
                        <span class="invalid-feedback" style="display: block;" v-if="ErrorMessage">
                            {{ ErrorMessage }}
                        </span>
                        <button @click="checkEmail" class="btn btn-success my-2">Kiểm tra</button>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="isCheck" class="row my-3" style="height: 80vh">
            <div class="col-md-4" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header">
                        <h3>Danh sách email</h3>
                    </div>
                    <div class="card-body" style="padding : 0">
                        <p v-if="listEmail.length == 0" class="list-email" style="color: blue">Bạn không có email nào</p>
                        <p v-else @click="getInfoEmail(list.id)" class="list-email" :class="[list.isUnread ? 'unread' : '']"
                            v-for="list in listEmail" :key="list.id">
                            {{ list.name }}: {{ list.email }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-8" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header">
                        <h3>Chi tiết email</h3>
                    </div>
                    <div class="card-body">
                        <h4>{{ emailDetail.subject }}</h4>
                        <p>{{ emailDetail.date }}</p>
                        <div v-html="emailDetail.body"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

import axios from 'axios';
import LoadingComponent from './LoadingComponent.vue';
export default {
    name: 'Test',
    data() {
        return {
            message: 'Hello World',
            ErrorMessage: '',
            isCheck: false,
            email: '',
            listEmail: [],
            loading: false,
            emailDetail: {},
            _messageResponse: ''
        }
    },
    components: {
        LoadingComponent
    },

    methods: {
        validateEmail(email) {
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        },
        checkEmail() {
            if (this.email == '') {
                this.ErrorMessage = 'Email không được để trống';
                return;
            }
            if (this.validateEmail(this.email) == false) {
                this.ErrorMessage = 'Email không hợp lệ';
                return;
            }
            this.loading = true;
            this.ErrorMessage = '';
            const loader = this.$loading.show({
            // Optional parameters
            });
            axios.post('/api/check-email', {
                email: this.email,
            }).then(response => {
                this.listEmail = response.data.data;
                this.isCheck = true;
                loader.hide();
            }).catch(error => {
                this.loading = false;
                loader.hide();
                this.isCheck = true;
                this._messageResponse = error.response.data.message;
            })
        },
        getInfoEmail(id) {
            this.loading = true;
            const loader = this.$loading.show({
            // Optional parameters
            });
            axios.post('/api/get-info-email', {
                id: id
            }).then(response => {
                this.emailDetail = response.data.data;
                loader.hide();
            }).catch(error => {
                this.loading = false;
                loader.hide();
            })
        }
    }
}
</script>
<style>
.list-email {
    list-style: none;
    padding: 20px 10px;
    margin: 0;
    cursor: pointer;
}

.list-email.unread {
    font-weight: 600;
    background: #f5f5f5;
}

.list-email:hover {
    background: #f5f5f5;
}
</style>
