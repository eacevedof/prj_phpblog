<template>
<div class="card">
    <div class="card-header">
        <h1>Articles</h1>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>id</th>
                <th>Master</th>
                <th>Detail</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in rows" :key="index">
                    <td v-for="(column, indexColumn) in columns" :key="indexColumn">{{item[column]}}</td>
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
            columns: ["id","master","detail"],
            rows: [],
        }
    },

    mounted() {
        this.rows = this.get_posts()
        console.log('Post List mounted.')
        alert("posts.vue mounted")
    },

    methods: {
      get_posts(){
        return   [
            {
                id:1,
                master: "Master 1",
                detail: "Detail 1"
            },
            {
                id:2,
                master: "Master 2",
                detail: "Detail 2"
            },
        ]
      },
    }
}
</script>
