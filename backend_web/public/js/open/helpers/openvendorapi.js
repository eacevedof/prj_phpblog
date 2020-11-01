async function get (url){
    let r = null
    try {
        r = await (await fetch(url)).json()
        return r.data
    }
    catch (e) {
        r = e
        console.error("error:",url,e)
        return {error:e}
    }
    finally {
        console.log("url:",url,"result:",r)
    }
}

const openvendorapi = {
    get_urlflag: codelang => `https://www.countryflags.io/${codelang}/flat/64.png`,
}

export default openvendorapi
