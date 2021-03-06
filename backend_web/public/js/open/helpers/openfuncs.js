//openfuncs

const funcs = {

    get_csrftoken: () => document.querySelector('#meta-csrf-token').getAttribute('content'),

    get_lastparam: () => (new URL(window.location)).pathname.split("/").slice(-1)[0] || null,

    pr: (any, title="pr") => {
      const json = JSON.stringify(any)
      alert(title.concat(":\n").concat(json))
      console.log(title,any)
    },

    is_error: response => typeof response.error !== "undefined" || (typeof response.errors !== "undefined" && response.errors.length>0),

    is_undefined: any => typeof any === "undefined",

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
        const from = "àáãäâèéëêìíïîòóöôùúüûñç·/_,:;";
        const to   = "aaaaaeeeeiiiioooouuuunc------";

        for (var i=0, l=from.length ; i<l ; i++) {
            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
        }

        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
            .replace(/\s+/g, '-') // collapse whitespace and replace by -
            .replace(/-+/g, '-'); // collapse dashes

        return str;
    },

    to_clipboard: str => {
        const txa = document.createElement('textarea');
        txa.value = str;
        document.body.appendChild(txa);
        txa.select()
        txa.setSelectionRange(0, 99999)
        document.execCommand("copy")
        document.body.removeChild(txa);
    },

    get_shuffled(a) {
        for (let i = a.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [a[i], a[j]] = [a[j], a[i]];
        }
        return a;
    },

    html_entities(str){
        const r = str.replace(/[&<>'"]/g,
            tag => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                "'": '&#39;',
                '"': '&quot;'
            }[tag])
        )
        return r
    },

    get_rnd: (min, max) => Math.floor(Math.random() * (max - min + 1) + min),

    get_uuid: (length=14) => {
        const ar = [
            "abcdefghijklmnopqrstuvxyz", //0: letras
            "0123456789"                 //1: números
        ]
        const r = new Array(length).fill(0).map(()=>{
            let i = funcs.get_rnd(0,1)
            let str = ar[i]
            str = funcs.get_rnd(0,1) ? str.toUpperCase() : str
            const max = str.length - 1
            i = funcs.get_rnd(0, max)
            return str.split("")[i]
        }).join("")
        return r
    }
}

export default funcs
//openfuncs
