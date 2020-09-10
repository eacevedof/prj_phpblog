const funcs = {

    get_csrftoken: () => document.querySelector('#meta-csrf-token').getAttribute('content'),

    get_lastparam: () => (new URL(window.location)).pathname.split("/").slice(-1)[0] || null,

    pr: (any, title="pr") => {
      const json = JSON.stringify(any)
      alert(title.concat(":\n").concat(json))
      console.log(title,any)
    },

    is_error: response => typeof response.error !== "undefined",

    get_form: strobj => {
        const form = new FormData()
        Object.keys(strobj).forEach( k => {
            form.append(k, strobj[k])
        })
        return form
    },

    get_date: strdate => {
        if(!strdate) return ""
        return new Date(strdate).toISOString().substr(0,10)
    },

    get_slug: str => {
        if(!str) return ""
        str = str.replace(/^\s+|\s+$/g, ''); // trim
        str = str.toLowerCase();

        // remove accents, swap ñ for n, etc
        var from = "àáãäâèéëêìíïîòóöôùúüûñç·/_,:;";
        var to   = "aaaaaeeeeiiiioooouuuunc------";

        for (var i=0, l=from.length ; i<l ; i++) {
            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
        }

        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
            .replace(/\s+/g, '-') // collapse whitespace and replace by -
            .replace(/-+/g, '-'); // collapse dashes

        return str;
    },

    get_uploadtoken: () => {
        const input = document.getElementById("upload-token");
        if(input) return input.value
        return ""
    },

    get_uploadomain: () => {
        const input = document.getElementById("upload-domain");
        if(input) return input.value
        return ""
    },

    to_clipboard: str => {
        const txa = document.createElement('textarea');
        txa.value = str;
        document.body.appendChild(txa);
        txa.select()
        txa.setSelectionRange(0, 99999)
        document.execCommand("copy")
        document.body.removeChild(txa);
    }
}

export default funcs
