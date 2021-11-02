<template>
    <div class="container">
        <div class="form-row">
            <div class="col-row">
                <input type="text" class="form-control" @keyup="searchTask" v-model="q" placeholder="Rechercher une tâche...">
            </div>
        </div>
        <add-task @Task-added="refresh"></add-task>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center" v-for="task in tasks.data" :key="task.id">
                <a href="#">{{ task.name }}</a>
                <div>
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#EditModal" @click="getTask(task.id)">
                    <i class="bi bi-pencil-fill mr-2" style="color: white;"></i>Editer
                </button>
                <button type="button" class="btn btn-danger" @click="deleteTask(task.id)"><i class="bi bi-trash-fill mr-2" style="color: white;"></i>Supprimer</button>
                </div>
            </li>
            <edit-task v-bind:taskToEdit = 'tasktoedit' @task-updated="refresh"></edit-task>
        </ul>
        <pagination :data="tasks" @pagination-change-page="getResults" class="mt-5"></pagination>
    </div>
</template>

<script>
import AddTaskComponent from './AddTaskComponent.vue';
import EditTaskComponent from './EditTaskComponent.vue';
    export default {
  components: { AddTaskComponent, EditTaskComponent },

        data() {
            return {
                tasks: {},
                tasktoedit: '',
                q: ''
            }
        },
        created() {
            axios.get('http://127.0.0.1:8000/taskslist')
                .then(response => this.tasks = response.data)
                .catch(error => console.log(error));
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
		// Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get('http://127.0.0.1:8000/taskslist?page=' + page)
                    .then(response => {
                        this.tasks = response.data;
                    });
            },
            getTask(id) {
                axios.get('http://127.0.0.1:8000/task/edit/' + id)
                    .then(response => this.tasktoedit = response.data)
                    .catch(error => console.log(error));
            },
            deleteTask(id){
                Swal.fire({
                    title: 'Etes vous sûre?',
                    text: "Cette action est irréversible",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirmer',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete('http://127.0.0.1:8000/task/' + id)
                            .then(response => this.tasks = response.data)
                            .catch(error => console.log(error));
                        Swal.fire(
                        'Effectué!',
                        'La tâche a été supprimée.',
                        'success'
                        );
                    }
                });
            },
            searchTask() {
                if (this.q.length > 0) {
                    axios.get('http://127.0.0.1:8000/taskslist/' + this.q)
                        .then(response => this.tasks = response.data)
                        .catch(error => console.log(error));
                } else {
                    axios.get('http://127.0.0.1:8000/taskslist')
                        .then(response => this.tasks = response.data)
                        .catch(error => console.log(error));
                }
            },
            refresh(tasks) {
                this.tasks = tasks.data;
            }
        }
    }
</script>
