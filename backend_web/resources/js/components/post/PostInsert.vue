<template>
    <div class="card">
        <div class="card-header">
            <h1>New article</h1>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="txt-description">Hidden description</label>
                        <input type="text" id="txt-description" v-model="description" maxlength="250" class="form-control"/>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="sel-id_type">Category</label>
                        <select id="sel-id_type" v-model="id_type" class="form-control">
                            <option value="">Choose one</option>
                            <option value="single-page">Single page</option>
                            <option value="blog-php">Php</option>
                            <option value="blog-js">Js</option>
                            <option value="blog-docker">Docker</option>
                        </select>
                    </div>
                    <div class="form-check col-md-4" style="padding-top:35px">
                        <input type="checkbox" id="chk-is_page" v-model="is_page" value="1" />
                        <label for="chk-is_page" class="form-check-label"><b>Is single page</b></label>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txt-slug">Slug</label>
                        <input type="text" id="txt-slug" v-model="slug" maxlength="150" class="form-control"/>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txt-url_final">Permalink</label>
                        <input type="text" id="txt-url_final" v-model="url_final" maxlength="300" class="form-control"/>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txt-title">title</label>
                        <input type="text" id="txt-title" v-model="title" maxlength="350" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txt-subtitle">subtitle</label>
                        <input type="text" id="txt-subtitle" v-model="subtitle" maxlength="250" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txa-content">content</label>
                        <textarea id="txa-content" v-model="content" rows="15" cols="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txa-excerpt">excerpt</label>
                        <textarea id="txa-excerpt" v-model="excerpt" maxlength="1000" rows="3" cols="5" class="form-control"></textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="txt-url_img1">Url img1</label>
                        <input type="text" id="txt-url_img1" v-model="url_img1" maxlength="300" class="form-control"/>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txt-url_img2">Url img2</label>
                        <input type="text" id="txt-url_img2" v-model="url_img2" maxlength="300" class="form-control"/>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txt-url_img3">Url img3</label>
                        <input type="text" id="txt-url_img3" v-model="url_img3" maxlength="300" class="form-control">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="sel-id_user">User</label>
                        <select id="sel-id_user" v-model="id_user" class="form-control">
                            <option value="1">1</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="sel-id_status">Status</label>
                        <select id="sel-id_status" v-model="id_status" class="form-control">
                            <option value="0">Disabled</option>
                            <option value="1">Published</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="dat-publish_date">Published</label>
                        <input type="date" id="dat-publish_date" v-model="publish_date" class="form-control" />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="dat-last_update">Last update</label>
                        <input type="date" id="dat-last_update" v-model="last_update" class="form-control" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txt-seo_title">SEO Title</label>
                        <input type="text" id="txt-seo_title" v-model="seo_title" maxlength="65" class="form-control"/>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txt-seo_description">SEO Description</label>
                        <input type="text" id="txt-seo_description" v-model="seo_description" maxlength="160" class="form-control"/>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="num-order_by">Position</label>
                        <input type="number" id="num-order_by" v-model="order_by" value="100" class="form-control"/>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return {
            form: {
                description: "",
                id_type: 0,
                is_page: 0,
                slug: "",
                url_final: "",
                title: "",
                subtitle: "",
                content: "",
                excerpt: "",
                url_img1: "",
                url_img2: "",
                url_img3: "",
                id_user: 1,
                id_status: 0,
                publish_date: "",
                last_update: "",
                seo_title: "",
                seo_description: "",
                order_by:100,
            }
        }
    },
    mounted() {
        console.log('Post Insert mounted.')
    }
}
</script>
