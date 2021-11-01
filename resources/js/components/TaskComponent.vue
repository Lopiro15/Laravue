<template>
    <div class="container">

        <add-task @Task-added="refresh"></add-task>
        <ul class="list-group">
            <li class="list-group-item" v-for="task in tasks.data" :key="task.id">
                <a href="#">{{ task.name }}</a>
            </li>
        </ul>
        <pagination :data="tasks" @pagination-change-page="getResults" class="mt-5"></pagination>
    </div>
</template>

<script>
import AddTaskComponent from './AddTaskComponent.vue';
    export default {
  components: { AddTaskComponent },

        data() {
            return {
                tasks: {}
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

            refresh(tasks) {
                this.tasks = tasks.data;
            }
        }
    }
</script>
