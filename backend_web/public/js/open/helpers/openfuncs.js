//openfuncs

const regexp = new RegExp(/[\'\"\:\,\.\?\;\+\!\(\)\?]/gi)

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

    get_wrongword(str1, str2){
        const ars1 = str1.trim().
                    toLowerCase().
                    split(" ").
                    map(str => str.replace(regexp,"").trim())
        const ars2 = str2.trim().
                    toLowerCase().
                    split(" ").
                    map(str => str.replace(regexp,"").trim())
        const r = ars1.filter((str,i) => i !== ars2.indexOf(str,i))[0]
        //console.log("get_wrongword ars1",ars1,"ars2",ars2,"r:",r)
        return r.length >0 ? r[0] : ""
    },

    is_good(str1, strexp) {
        const answeer = str1.toLowerCase().split(" ").map(str => str.replace(regexp,"").trim()).join(" ")
        const expected = strexp.toLowerCase().split(" ").map(str => str.replace(regexp,"").trim()).join(" ")
        return answeer===expected
    }
}

export default funcs
//openfuncs
