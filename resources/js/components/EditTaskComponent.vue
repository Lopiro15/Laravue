<template>
    <div>
        <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditModalLabel">Edit Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="name">Nom de la tâche</label>
                            <textarea name="name" class="form-control" id="name" rows="4" v-model="taskToEdit.name"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal" @click="update"><i class="bi bi-check mr-2" style="color: white;"></i>Enregistrer</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['taskToEdit'],
    methods: {
        update() {
            axios.patch('http://127.0.0.1:8000/task/edit/' + this.taskToEdit.id, {
                name: this.taskToEdit.name
            })
            .then(response => this.$emit('task-updated', response))
            .catch(error => console.log(error));
        }
    }
}
</script>