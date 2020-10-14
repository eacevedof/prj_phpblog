<template>
<div class="card">

    <div class="d-flex pt-2" style="flex-wrap: wrap;">
        <input type="text" class="form-control col-9 ml-4 mb-2" placeholder="...search"
               ref="search"
               v-model="filter.search"
               @focus="$event.target.select()"
               v-on:keyup.enter="on_search()"
        />
        <button type="button" class="btn btn-dark ml-4"
                :disabled="issending" v-on:click="on_search()"
        ><i class="fa fa-search" aria-hidden="true"></i> Search</button>
    </div>
    <div class="card-body mt-0">
        <div class="row card-header res-formheader">
            <div class="col-md-9">
                <h1>Subjects <sub>({{rows.length}})</sub></h1>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary res-btnformheader" :disabled="issending" v-on:click="rows_load()">
                    {{btnsend}}
                    <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                </button>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>id</th>
                <th>Title</th>
                <th>Permalink</th>
                <th>Description</th>
                <th>Draft</th>
                <th>Edit</th>
                <th>Remove</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in rows" :key="index">
                    <td
                        v-for="(column, idx) in columns" :key="idx"
                        v-bind:class="{ 'res-tddel': item.delete_date }"
                    >{{item[column]}}</td>
                    <td>
                        <a v-if="item.id_status==0" class="btn btn-dark" target="_blank" :href="'/blog/draft/'+item.id">
                            <i class="fa fa-window-maximize" aria-hidden="true"></i>
                        </a>
                        <a v-if="item.id_status!=0" class="btn btn-info" target="_blank" :href="item.url_final">
                            <i class="fa fa-window-maximize" aria-hidden="true"></i>
                        </a>
                    </td>
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
import funcs from "../../../app/funcs"
import CONST from "../../../app/constants"
import db from "../../../app/db"

const csrftoken = funcs.get_csrftoken()

export default {
    data(){
        return {
            issending: false,
            btnsend: CONST.BTN_INISTATE_REFRESH,
            columns: ["id","title","url_final","description"],

            rows: [],

            filter:{
                original: [],
                search: "",
            }
        }
    },

    mounted() {
        this.rows_load()
    },

    methods: {
        rows_load(){
            console.log("rows_load")
            const self = this
            self.issending = true
            self.btnsend = CONST.BTN_IN_PROGRESS
            const url = `/api/subject`
            fetch(url, {
                method: 'get',
            })
            .then(response => response.json())
            .then(response => {
                //console.log("load.reponse",response)

                if(funcs.is_error(response)) {
                    return Swal.fire({
                        icon: 'warning',
                        title: CONST.TITLE_ERROR,
                        html: response.error,
                    })
                }

                self.rows = response.data
                //console.log("rows_load.rows"); console.table(self.rows)
                self.filter.original = response.data
                self.filter.search = db.select("subject-search")
                self.on_search()

            })
            .catch(error => {
                console.log("CATCH ERROR insert",error)
                Swal.fire({
                    icon: 'error',
                    title: CONST.TITLE_SERVERROR,
                    html: error.toString(),
                })
            })
            .finally(() => {
                self.issending = false;
                self.btnsend = CONST.BTN_INISTATE_REFRESH
            })
        },//load

        on_search(){
            if(!this.filter.search){
                db.delete("subject-search")
                this.rows = [...this.filter.original]
                return
            }
            if(this.filter.original.length === 0) return
            const fields = Object.keys(this.filter.original[0])
            if(!fields) return

            const search = this.filter.search.toString().trim()
            db.save("subject-search",search)
            const rows = this.filter.original.filter(obj => {
                const exist = fields.some(field => {
                    if(obj[field]===null) return false
                    const str = obj[field].toString()
                    return str.indexOf(search) !== -1
                })
                return exist
            })

            this.rows = [...rows]
            //console.log("rows filtered"); console.table(this.rows)
        },

        edit(id){
            const url = "/adm/subject/update/"+id
            document.location = url
            //window.open(url, "_blank")
        },

        remove(id){
            if(confirm(CONST.CONFIRM)){
                console.log("fetching")
                const self = this
                self.issending = true
                self.btnsend = CONST.BTN_IN_PROGRESS
                const url = `/api/subject/${id}`
                fetch(url, {
                    method: 'delete',
                    headers:{
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({_token:csrftoken,_action:"subject.delete"})
                })
                .then(response => response.json())
                .then(response => {
                    console.log("remove.response",response)

                    if(funcs.is_error(response)) {
                        return Swal.fire({
                            icon: 'warning',
                            title: CONST.TITLE_ERROR,
                            html: response.error,
                        })
                    }

                    self.rows_load()

                    Swal.fire({
                        icon: 'success',
                        title: `Subject: ${id} has been removed`,
                        html: `<b>&#128578;</b>`,
                    })

                })
                .catch(error => {
                    console.log("CATCH ERROR remove",error)
                    Swal.fire({
                        icon: 'error',
                        title: CONST.TITLE_SERVERROR,
                        html: error.toString(),
                    })
                })
                .finally(() => {
                    self.issending = false;
                    self.btnsend = CONST.BTN_INISTATE_REFRESH
                })
            }
        },
    }
}
</script>
