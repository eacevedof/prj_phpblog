const custom = {
    get_csrftoken: () => document.querySelector('#meta-csrf-token').getAttribute('content')
}

export default custom
