<template>
<div class="card">
    <div class="card-body">
        <div class="row card-header app-formheader">
            <div class="col-md-9">
                <h1>Posts</h1>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary app-btnformheader" :disabled="issending" v-on:click="load()">
                    {{btnsend}}
                    <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                </button>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>id</th>
                <th>Description</th>
                <th>Title</th>
                <th>Edit</th>
                <th>Remove</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in rows" :key="index">
                    <td v-for="(column, indexColumn) in columns" :key="indexColumn">{{item[column]}}</td>
                    <td>
                        <button class="btn btn-primary" :disabled="issending"  v-on:click="edit(item.id)">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-danger" :disabled="issending"  v-on:click="remove(item.id)">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</template>

<script>
import custom from "../../../custom"
let csrftoken = custom.get_csrftoken()
const BTN_INISTATE = "Refresh"
const BTN_IN_PROGRESS = "In progress..."

export default {
    data(){
        return {
            issending: false,
            btnsend: BTN_INISTATE,
            columns: ["id","description","title"],
            rows: [],
        }
    },

    mounted() {
        this.load()
    },

    methods: {
        load(){
            console.log("...loading")
            const self = this
            self.issending = true
            self.btnsend = BTN_IN_PROGRESS
            const url = `/api/post`
            fetch(url, {
                method: 'get',
            })
            .then(response => response.json())
            .then(response => {

                console.log("load.reponse",response)

                if(custom.is_error(response)) {
                    return Swal.fire({
                        icon: 'warning',
                        title: 'This action could not be completed! &#58384;',
                        text: response.error,
                    })
                }

                self.rows = response.data

            })
            .catch(error => {
                console.log("CATCH ERROR insert",error)
                Swal.fire({
                    icon: 'error',
                    title: 'Opps! Some error occurred &#9785;',
                    text: error.toString(),
                })
            })
            .finally(() => {
                self.issending = false;
                self.btnsend = BTN_INISTATE
            })
        },//load

        edit(id){
            //alert("edit")
            const url = "/adm/post/update/"+id
            document.location = url
            //window.open(url, "_blank")
        },

        remove(id){
            if(confirm("Are you sure to commit this operation?")){
                console.log("fetching")
                const self = this
                self.issending = true
                self.btnsend = BTN_IN_PROGRESS
                const url = `/adm/api/post/${id}`
                fetch(url, {
                    method: 'delete',
                })
                .then(response => response.json())
                .then(response => {
                    console.log("remove.response",response)

                    if(custom.is_error(response)) {
                        return Swal.fire({
                            icon: 'warning',
                            title: 'This action could not be completed! &#58384;',
                            text: response.error,
                        })
                    }

                    Swal.fire({
                        icon: 'success',
                        title: `Post: ${id} has been removed`,
                        html: `<b>&#128578;</b>`,
                    })

                })
                .catch(error => {
                    console.log("CATCH ERROR remove",error)
                    Swal.fire({
                        icon: 'error',
                        title: 'Opps! Some error occurred &#9785;',
                        text: error.toString(),
                    })
                })
                .finally(() => {
                    self.issending = false;
                    self.btnsend = BTN_INISTATE
                })
            }
        },
    }
}
</script>
