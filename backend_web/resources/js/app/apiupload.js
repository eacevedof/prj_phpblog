import funcs from "./funcs";

const apiupload = {
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

    get_files: async (folder) => {
        try {
            const url = funcs.get_uploadomain().concat("/files")
            const form = new FormData()
            form.append("resource-usertoken",funcs.get_uploadtoken())
            form.append("folderdomain",folder)

            const prom = await fetch(url,{method: 'post', body: form})
            const r = (await prom.json()).data.files
            return r
        }
        catch (e) {
            return {error:e}
        }
    },
}

export  default apiupload
