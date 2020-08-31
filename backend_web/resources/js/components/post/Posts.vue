<template>
<div class="card">
    <div class="card-header">
        <h1>Articles</h1>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>2018</th>
                <th>2017</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in rows" :key="index">
                    <td v-for="(column, indexColumn) in columns" :key="indexColumn">{{item.$column}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</template>

<script>
export default {
    data(){
        return {
            columns: ["master","detail"],
            rows: [
                {
                    master: "Master",
                    detail: "Detail"
                },
                {
                    master: "Master",
                    detail: "Detail"
                },
            ],
        }
    },

    mounted() {
        console.log('Post List mounted.')
    }
}
</script>
