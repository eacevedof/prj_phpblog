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
        <div class="row card-header p-0">
            <div class="col-md-8">
                <sub>({{rows.length}})</sub><p><b>{{sentence.translatable}}</b></p>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary" :disabled="issending" v-on:click="insert">
                    Insert
                    <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                </button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary" :disabled="issending" v-on:click="rows_load">
                    {{btnsend}}
                    <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                </button>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>id</th>
                <th>Lang</th>
                <th>Translated</th>
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

<script type="module" src="./sentencesentencetrs.js"></script>
