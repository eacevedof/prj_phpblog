const subject = {
    get_by_id: async (idsubject) =>{
        const url = `/api/language/subject/${idsubject}`
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
            console.log("subject.r",r)
        }
    },
}
export default subject
