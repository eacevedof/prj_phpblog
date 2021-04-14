import funcs from "../../../app/funcs"
import CONST from "../../../app/constants"
import apiupload from "../../../app/apiupload";
import db from "../../../app/db";

export default {

    data(){
        return {
            issending: false,
            btnsend: CONST.BTN_INISTATE_REFRESH,
            btnupload: CONST.BTN_INISTATE_UPLOAD,

            selfolder: "eduardoaf.com",

            maxuploadsize: 0,
            isoversized: false,
            overbytes: 0,
            filessize: 0,

            folders: [],
            rows: [],

            upload:{
                urlupload: "",
                files: [],
                urlimage: "",
            }
        }
    },

    async mounted() {
        console.log("upload.async mounted()")
        this.maxuploadsize = await apiupload.get_maxsize()
        this.maxuploadsize = parseInt(this.maxuploadsize)
        await this.load_folders()
        await this.load_rows()
        this.load_lastslug()
        this.$refs.urlupload.focus();
        //this.$refs.urlupload.setSelectionRange(0, 3);
        setTimeout(() => this.$refs.urlupload.setSelectionRange(0, 3))
        window.addEventListener("paste", this.on_paste);//window.on-paste
    },

    methods: {
        on_paste(e){
            const files = e.clipboardData.files
            console.log("on_paste.files",files)
            if (files.length===0) return

            this.upload.urlimage = URL.createObjectURL(files[0])
            this.$refs.filesupload.files = files
            console.log("pasted:", files, this.$refs.filesupload)
            const event = document.createEvent("UIEvents");
            event.initUIEvent("change", true, true);
            this.$refs.filesupload.dispatchEvent(event);
            this.$refs.urlupload.focus();
        },

        load_lastslug(){
            const slug = db.select("last-slug")
            if(slug){
                this.upload.urlupload = `xxx::${slug};`
                db.delete("last-slug")
            }
        },

        async load_folders() {this.folders = await apiupload.get_folders() },

        async load_rows() {
            this.issending = true
            this.btnsend = CONST.BTN_IN_PROGRESS

            try{
                const r = await apiupload.get_files(this.selfolder)
                //funcs.pr(r,"load_rows")
                if(funcs.is_error(r)) {
                    return Swal.fire({
                        icon: 'warning',
                        title: CONST.TITLE_ERROR,
                        html: r.error,
                    })
                }
                this.rows = r
            }
            catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: CONST.TITLE_SERVERROR,
                    html: error.toString(),
                })
            }
            finally {
                this.issending = false;
                this.btnsend = CONST.BTN_INISTATE_REFRESH
            }
        },//load_rows

        async remove_file(urlfile){
            if(confirm(CONST.CONFIRM)) {
                this.issending = true
                this.btnsend = CONST.BTN_IN_PROGRESS

                try {
                    const r = await apiupload.remove_file(urlfile)
                    if (funcs.is_error(r)) {
                        return Swal.fire({
                            icon: 'warning',
                            title: CONST.TITLE_ERROR,
                            html: r.error,
                        })
                    }

                    this.$toast.info(`Resource removed: ${r[0]}`)
                    await this.load_rows()
                }
                catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: CONST.TITLE_SERVERROR,
                        html: error.toString(),
                    })
                }
                finally {
                    this.issending = false;
                    this.btnsend = CONST.BTN_INISTATE_REFRESH
                }
            }
        },//remove_file

        async upload_byurl(){
            console.log("upload_byurl")

            try {
                this.issending = true
                this.btnupload = CONST.BTN_IN_PROGRESS

                const r = await apiupload.post_url(this.selfolder, this.upload.urlupload)

                if(funcs.is_error(r)) {
                    return Swal.fire({
                        icon: 'warning',
                        title: CONST.TITLE_ERROR,
                        html: r.error,
                    })
                }
                this.savelast(r.slice(-1)[0])
                this.$toast.success(`Files "${r}" uploaded`)
                this.upload.urlupload = ""
                this.$refs.urlupload.focus();
            }
            catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: CONST.TITLE_SERVERROR,
                    html: error.toString(),
                })
            }
            finally {
                this.issending = false;
                this.btnupload = CONST.BTN_INISTATE_UPLOAD
            }
        }, //upload by url

        async upload_files(){
            console.log("upload_files")
            try {
                this.issending = true
                this.btnupload = CONST.BTN_IN_PROGRESS

                console.log("files:",this.upload.files[0],"name",this.upload.files[0].name,"urlupload",this.upload.urlupload)
                if(this.upload.files.length === 1){
                    Object.defineProperty(this.upload.files[0], 'name', {
                        writable: true,
                        value: funcs.get_slug(this.upload.urlupload).concat(".png")
                    });
                }

                const r = await apiupload.post_files(
                    this.selfolder,
                    this.upload.files
                )

                if (funcs.is_error(r)) {
                    return Swal.fire({
                        icon: 'warning',
                        title: CONST.TITLE_ERROR,
                        html: r.error,
                    })
                }

                this.savelast(r.url.slice(-1)[0])
                this.$toast.success(`Files uploaded (${r.url.length}): ${r.url.join(", ")}`)
                if(r.warning.length>0)
                    this.$toast.warning(`Files not uploaded (${r.warning.length}): ${r.warning.join(", ")}`)
                this.reset_filesupload()
            }
            catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: CONST.TITLE_SERVERROR,
                    html: error.toString(),
                })
            }
            finally {
                this.issending = false;
                this.btnupload = CONST.BTN_INISTATE_UPLOAD
            }
        },//upload files

        async on_upload(){
            if(!this.upload.urlupload.trim() && this.upload.files.length===0){
                this.$toast.warning("You must fill input with a valid url")
                return this.$refs.urlupload.focus();
            }

            if(this.upload.files.length===0){
                await this.upload_files()
            }
            else if(this.upload.urlupload){
                await this.upload_byurl()
            }
            await this.load_rows()
        },//on_upload

        copycb(i){
            const el = document.getElementById("rawlink-"+i)
            if(el) {
                const url = el.innerText
                funcs.to_clipboard(url)
                this.savelast(url)
                this.$toast.success(`in clipboard and last uri`)
            }
        },

        on_fileschange(){
            this.upload.files = this.$refs.filesupload.files || []

            let size = 0
            for(const file of this.upload.files)
                size += file.size

            this.filessize = size
            this.isoversized = (size>=this.maxuploadsize)
            this.overbytes = (size - this.maxuploadsize)
        },

        reset_filesupload(){
            this.$refs.filesupload.value = ""
            this.upload.files = []
            this.filessize = 0
            this.isoversized = false
            this.overbytes = 0
        },

        savelast(url){
            if(!funcs.is_undefined(url))
                db.save("last-upload",url)
        }
    }
}
