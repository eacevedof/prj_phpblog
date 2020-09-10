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
        let r = null
        try {
            const url = funcs.get_uploadomain().concat("/folders")
            const form = new FormData()
            form.append("resource-usertoken",funcs.get_uploadtoken())
            r = await fetch(url,{method: 'post', body: form}).then(response => response.json())

            console.log("get_folders.response.data.folders",r.data.folders)
            //r = JSON.parse(JSON.stringify(r.data.folders))
            r = r.data.folders
            return r
        }
        catch (e) {
            return {error:e}
        }
    }
}

export  default apifetch
