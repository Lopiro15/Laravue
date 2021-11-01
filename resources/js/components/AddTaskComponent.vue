<template>
    <div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Ajoutez une tâche
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="name">Nom de la tâche</label>
                        <textarea name="name" class="form-control" id="name" rows="4" v-model="name"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-success" @click="taskStore">Creer ma tâche</button>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: '',
                id: '',
                created_at: Date.now(),
                updated_at: ''
            }
        },
        methods: {
            taskStore() {
                axios.post('http://127.0.0.1:8000/taskslist', {
                    name: this.name,
                    id: this.id,
                    created_at: this.created_at,
                    updated_at: this.updated_at
                })
                .then(response => this.$emit('Task-added', response))
                .catch(error => console.log(error));
                this.name = '';
            }
        }
    }
</script>