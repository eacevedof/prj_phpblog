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

    is_good(str1, strexp) {
        const answeer = str1.toLowerCase().split(" ").map(str => str.replace(regexp,"").trim()).filter(str => str!=="").join(" ")
        const expected = strexp.toLowerCase().split(" ").map(str => str.replace(regexp,"").trim()).join(" ")
        //console.log("answer:",answeer,"expected:",expected)
        return answeer===expected
    },

    get_wrongword(str1, str2){
        const aranswer = str1.trim().
                    toLowerCase().
                    split(" ").
                    map(str => str.replace(regexp,"").trim()).
                    filter( str => str!=="")
        //expected
        const arexpect = str2.trim().
                    toLowerCase().
                    split(" ").
                    map(str => str.replace(regexp,"").trim())
        const r = aranswer.filter((str,i) => i !== arexpect.indexOf(str,i))[0]
        //console.log("get_wrongword aranswer",aranswer,"arexpect",arexpect,"r:",r)
        return r ? r : aranswer[0]
    },

    get_questions(quests, attempts, ishow){
        ishow = ishow || 20
        const wrongnok = attempts.filter(obj => parseInt(obj.iresult)===0 || parseInt(obj.iresult)===2).map(obj => obj.id_sentence)
        const inwrong = quests.filter(quest => wrongnok.includes(quest.id)).map(obj => obj.id)
        const notin = quests.filter(quest => !wrongnok.includes(quest.id)).map(obj => obj.id)
        const final = quests.filter(quest => inwrong.includes(quest.id))
                            .concat(quests.filter(quest => notin.includes(quest.id)))
        return final.filter((quest, i)=> i< ishow)
    },

}

export default funcs
//openfuncs
