<link href="{{ asset('assets/enlighter/enlighterjs.min.css') }}" rel="stylesheet" />
<script src="{{ asset('assets/cropper-js/cropper.js') }}"></script>
<template>
    <div class="card">
        <div class="row m-0 p-0 mt-4">
            <div class="form-group col-md-10 mb-2">
                <input type="text" class="form-control" placeholder="url to upload::name"
                       ref="urlupload"
                       v-model="upload.urlupload"
                       v-on:keyup.enter="on_upload()"
                />
            </div>
            <div class="form-group col-md-10 mb-2">
                <input type="file" class="form-control" multiple
                       ref="filesupload"
                       @change="on_fileschange()"
                />
                <img :src="upload.urlimage" ref="imgpreview">
            </div>
            <div class="form-group col-md-2 mb-0">
                <button type="button" class="btn btn-dark"
                        :disabled="issending || isoversized" v-on:click="on_upload()"
                >
                    {{btnupload}}
                    <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                </button>
            </div>
            <div class="d-flex m-0 mt-1 pl-3" style="flex-wrap: wrap;">
                <small class="badge bg-info text-white">max upload: {{maxuploadsize.toLocaleString("en")}}</small>
                <small v-if="filessize>0" class="badge bg-warning">selected: {{filessize.toLocaleString("en")}}</small>
                <small v-if="isoversized" class="badge bg-danger text-white">oversized: {{overbytes.toLocaleString("en")}}</small>
                <small v-for="(file, i) in upload.files" :key="i">{{i+1}} - {{file.name}} ({{ file.size.toLocaleString("en") }})&nbsp;&nbsp;</small>
            </div>
        </div>

        <!-- card start -->
        <div class="card-body">
            <div class="row card-header res-formheader">
                <div class="col-md-6 mt-2">
                    <h1>Uploaded files:</h1><small>({{rows.length}})</small>
                </div>
                <div class="col-md-3">
                    <div class="form-group mt-3">
                        <select id="sel-folders" v-model="selfolder" class="form-control" required>
                            <option v-for="(folder, i) in folders" :value="folder" :key="i">{{folder}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <button class="btn btn-primary" :disabled="issending" v-on:click="load_rows()">
                        {{btnsend}}
                        <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                    </button>
                </div>
            </div>

            <!-- cards -->
            <div class="row">
                <div class="col-sm-3" v-for="(url, i) in rows" :key="i">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">
                                <a :href="url" target="_blank">
                                    <img :src="url" class="container-fluid"/>
                                </a>
                                <small :id="'rawlink-'+i">{{url}}</small>
                            </p>
                        </div>

                        <div class="card-footer text-muted">
                            <button class="btn btn-info" :disabled="issending"  v-on:click="copycb(i)">
                                <i class="fa fa-clipboard" aria-hidden="true"></i>
                            </button>
                            <button class="btn btn-danger" :disabled="issending"  v-on:click="remove_file(url)">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Toasts
            :show-progress="true"
            :rtl="false"
            :max-messages="5"
            :time-out="5000"
            :closeable="true"
        ></Toasts>
    </div>
</template>

<script type="module" src="./updateindex.js"></script>
