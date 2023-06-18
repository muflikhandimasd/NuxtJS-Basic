<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>
                    Create Note
                    <NuxtLink to="/notes" class="btn btn-danger">Back</NuxtLink>
                </h4>
            </div>
            <div class="card-body">
                <div v-if="isLoading" class="text-center">
                   <Loading :title="isLoadingTitle"/>
                </div>
                <div v-else>
                    <form @submit.prevent="saveNote">
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" v-model="note.title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Body</label>
                        <textarea v-model="note.body" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
                </div>
              
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default{
    name: 'CreateNote',
    data(){
        return{
            note: {
                title: '',
                body: ''
            },
            isLoading : false,
            isLoadingTitle: 'Loading...'

        }
    },
    methods: {
        saveNote(){
            this.isLoading = true;
            this.isLoadingTitle = 'Saving note...';
            axios.post('http://localhost:9000/api/notes', this.note).then((response) => {
                this.note.title = '';
                this.note.body = '';
                this.isLoading = false;
                this.isLoadingTitle = 'Loading...';
                this.$router.push('/');
            }).catch((error) => {
                console.log(error);
                this.isLoading = false;
                this.isLoadingTitle = 'Loading...';
            });

        }
    }

}
</script>