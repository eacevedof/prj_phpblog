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
    },

    post_sslencrypt: async (obj) => {
        try {
            const url = "/services/test/opensslencrypt"
            const form = new FormData()
            form.append("_token",funcs.get_csrftoken())
            form.append("action","test.sslencrypt")
            form.append("method",obj.method)
            form.append("function",obj.func)
            form.append("password",obj.password)
            form.append("salt",obj.salt)
            form.append("option",obj.option)
            form.append("iv",obj.iv)
            form.append("data",obj.data)

            const prom = await fetch(url,{method: 'post', body: form})
            const r = (await prom.json())
            return r
        }
        catch (e) {
            return {error:e}
        }
    },

    get_sslmethods: async () => {
        try {
            const url = "/api/app-array/sll-methods"
            const prom = await fetch(url)
            const r = (await prom.json())
            return r
        }
        catch (e) {
            return {error:e}
        }
    },

    get_status_hacks: async ({domain, hacks}) => {
        try {
            //no-cors: https://developer.mozilla.org/es/docs/Web/API/Fetch_API/Utilizando_Fetch
            const promises = hacks.filter((hack,i) => i<2).map( hack => fetch(
                `${domain}${hack.request_uri}`,
                {mode:'no-cors'}
            ))

            const r = await Promise.all(promises)

            console.log("rrrrrr",r)
            return r
        }
        catch (e) {
            console.log("error:",e)
            return {error:e}
        }
    }


}
export default openapi
