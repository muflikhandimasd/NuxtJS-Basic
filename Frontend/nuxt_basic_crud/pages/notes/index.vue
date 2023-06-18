<template>
   <div>
    <div class="card">
        <div class="card-header">
            <h4>
                Notes
                <NuxtLink to="/notes/create" class="btn btn-primary">Create</NuxtLink>
            </h4>
        </div>
        <div class="card-body">
            <div v-if="isLoading" class="text-center">
               <Loading :title="isLoadingTitle"/>
            </div>
            <div v-else>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Body</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(note, index) in notes" :key="note.id">
                            <td>{{ index+1 }}</td>
                            <td>{{ note.title }}</td>
                            <td>{{ note.body }}</td>
                            <td>
                                <NuxtLink :to="`/notes/${note.id}`" class="btn btn-warning">Edit</NuxtLink>
                                <button @click="deleteNote(note.id)" class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            </div>
    </div>
   </div>
</template>

<script>
import axios from 'axios';

export default{
    name: 'Notes',
    data(){
        return{
            notes: [],
            isLoading : false,
            isLoadingTitle: 'Loading...'

        }
    },
    mounted(){
        this.getNotes();
    },
    methods: {
        getNotes(){
            this.isLoading = true;
            this.isLoadingTitle = 'Loading notes...';
            axios.get('http://localhost:9000/api/notes').then((response) => {
                this.notes = response.data.data;
                this.isLoading = false;
                this.isLoadingTitle = 'Loading...';
            }).catch((error) => {
                console.log(error);
                this.isLoading = false;
                this.isLoadingTitle = 'Loading...';
            })
        },
        deleteNote(id){
            this.isLoading = true;
            this.isLoadingTitle = 'Deleting note...';
            axios.delete(`http://localhost:9000/api/notes/${id}`).then((response) => {
                this.note.title = '';
                this.note.body = '';
                this.isLoading = false;
                this.isLoadingTitle = 'Loading...';
                this.$router.push('/');
            })
        }
    },

    

}
</script>