import funcs from "/js/open/helpers/openfuncs.js"

const openapi = {

    get_maxsize: async () => {
        try {
            const url = "/infrastructure/get-max-upload-size"
            const prom = await fetch(url)
            const r = (await prom.json()).data.maxuploadsize
            //console.log("r",r)
            return r
        }
        catch (e) {
            return {error:e}
        }
    },

    post_file: async (folder,files) => {
        try {
            const url = "/services/conversion/pdf-to-jpg"
            const form = new FormData()
            form.append("resource-usertoken",funcs.get_uploadtoken())
            form.append("folderdomain",folder)

            for(const file of files)
                form.append("files[]", file, file.name);

            const prom = await fetch(url,{method: 'post', body: form})
            const r = (await prom.json()).data
            return r
        }
        catch (e) {
            return {error:e}
        }
    },

    post_passwconfig: async (obj) => {
        try {
            const url = "/services/generate/password"
            const form = new FormData()
            form.append("_token",funcs.get_csrftoken())
            form.append("action","generate.password")
            form.append("length",obj.length);
            form.append("noletters",obj.noletters);
            form.append("nonumbers",obj.nonumbers);
            form.append("nochars",obj.nochars);

            const prom = await fetch(url,{method: 'post', body: form})
            const r = (await prom.json()).data
            return r
        }
        catch (e) {
            return {error:e}
        }
    },

    post_pregmatchaall: async (obj) => {
        try {
            const url = "/services/test/pregmatchall"
            const form = new FormData()
            form.append("_token",funcs.get_csrftoken())
            form.append("action","test.pregmatchall")
            form.append("pattern",obj.pattern)
            form.append("flags",obj.flags)
            form.append("text",obj.text)
            const prom = await fetch(url,{method: 'post', body: form})
            const r = (await prom.json())
            return r
        }
        catch (e) {
            return {error:e}
        }
    },

    post_formatquery: async (obj) => {
        try {
            const url = "/services/formatter/sql-query"
            const form = new FormData()
            form.append("_token",funcs.get_csrftoken())
            form.append("action","format.sqlquery")
            form.append("query",obj.query)

            const prom = await fetch(url,{method: 'post', body: form})
            const r = (await prom.json())
            return r
        }
        catch (e) {
            return {error:e}
        }
    }
}
export default openapi
