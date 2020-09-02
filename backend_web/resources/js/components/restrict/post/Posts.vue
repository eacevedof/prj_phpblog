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
                <th>Description</th>
                <th>Title</th>
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
import custom from "../../../custom"
let csrftoken = custom.get_csrftoken()
const BTN_INISTATE = "Buscar"
const BTN_IN_PROGRESS = "Procesando..."

export default {
    data(){
        return {
            columns: ["id","description","title"],
            rows: [],
        }
    },

    mounted() {
        this.fetch()
    },

    methods: {
        fetch(){
            console.log("fetching")
            const self = this
            self.issending = true
            self.btnsend = BTN_IN_PROGRESS
            const url = `/api/post`

            //const data = new FormData();
            //data.append("_token",csrftoken)
            //data.append("action","post.index")

            fetch(url, {
                method: 'get',
                //body: data,
            })
            //.then(response => console.log(response,"RESPONSE"))
            .then(response => response.json())
            .then(response => {

                console.log("reponse",response)

                if(typeof response.error !== "undefined") {
                    return Swal.fire({
                        icon: 'warning',
                        title: 'Esta acción no se ha podido completar',
                        text: response.error,
                    })
                }

                self.rows = response.data

            })
            .catch(error => {
                console.log("CATCH ERROR insert",error)
                Swal.fire({
                    icon: 'error',
                    title: 'Vaya! Ha ocurrido un error',
                    text: error.toString(),
                })
            })
            .finally(() => {
                self.issending = false;
                self.btnsend = BTN_INISTATE
            })
        },//insert

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
