<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        Soy el posts component
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "post-component",
    mounted() {
        console.log('Post Component mounted.')
    }
}
</script>
