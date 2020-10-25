const sentence = {
    get_by_id: async (idsentence) =>{
        const url = `/api/language/sentence/${idsentence}`
        let r = null
        try {
            r = await (await fetch(url)).json()
            return r.data
        }
        catch (e) {
            r = e
            return {error:e}
        }
        finally {
            console.log("sentence.r",r)
        }
    },
}
export default sentence
