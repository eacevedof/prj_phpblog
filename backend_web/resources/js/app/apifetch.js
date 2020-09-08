//import funcs from "./funcs";

const apifetch = {
    get_categories: async ()=>{
        //const _token = funcs.get_csrftoken()
        const url = "/api/post/category"
        const r = (await fetch(url)).json()
        return r
    }
}

export  default apifetch
