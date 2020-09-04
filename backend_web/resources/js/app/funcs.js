const funcs = {

    get_csrftoken: () => document.querySelector('#meta-csrf-token').getAttribute('content'),

    get_lastparam: () => (new URL(window.location)).pathname.split("/").slice(-1)[0] || null,

    pr: (any, title="") => {
      const json = JSON.stringify(any)
      alert(title.concat(":\n").concat(json))
    },

    is_error: response => typeof response.error !== "undefined",

    get_form: strobj => {
        const form = new FormData()
        Object.keys(strobj).forEach( k => {
            form.append(k, strobj[k])
        })
        return form
    }
}

export default funcs
