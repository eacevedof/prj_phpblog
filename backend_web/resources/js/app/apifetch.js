import funcs from "./funcs";

const apifetch = {
    get_categories: async ()=>{
        //const _token = funcs.get_csrftoken()
        const url = "/api/post/category"
        let r = null
        try {
            r = await (await fetch(url)).json()
            return r.data
        }
        catch (e) {
            r = e
            return {error:e}
        }
        finally {
            console.log("get_categories.r",r)
        }
    },

    get_folders: async () => {
        try {
            const url = funcs.get_uploadomain().concat("/folders")
            const form = new FormData()
            form.append("resource-usertoken",funcs.get_uploadtoken())
            const prom = await fetch(url,{method: 'post', body: form})
            const r = (await prom.json()).data.folders
            return r
        }
        catch (e) {
            return {error:e}
        }
    },

    get_maxsize: async () => {
        try {
            const url = funcs.get_uploadomain().concat("/get-max-upload-size")
            const form = new FormData()
            form.append("resource-usertoken",funcs.get_uploadtoken())
            const prom = await fetch(url,{method: 'post', body: form})
            const r = (await prom.json()).data.maxuploadsize
            return r
        }
        catch (e) {
            return {error:e}
        }
    },

    get_uploadrows: async () => {
        try {
            const url = funcs.get_uploadomain().concat("/files")
            const form = new FormData()
            form.append("resource-usertoken",funcs.get_uploadtoken())
            form.append("folderdomain",self.selfolder)

            const prom = await fetch(url,{method: 'post', body: form})
            const r = (await prom.json()).data.files
            return r
        }
        catch (e) {
            return {error:e}
        }
    },
}

export  default apifetch
