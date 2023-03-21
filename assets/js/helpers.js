export const getEl = id => document.getElementById(id);
export const getEls = cn => document.querySelectorAll(cn);
export const createEl = ns => document.createElement(ns);
export const sleep = ms => new Promise(resolve => setTimeout(resolve, ms));
export const removeEl = el => {
    if(isRendered(el)) getEl(el).remove();
}
export const isRendered = el => getEl(el) ? true : false;
export const getAcfField = async (name, post_id) => {
    let route = '/wp-admin/admin-ajax.php',
        data = new URLSearchParams(),
        results;

    data.append('action', 'qcmptGetAcfField');
    data.append( 'nonce', qcmpt_ajax.nonce );
    data.append( 'is_user_logged_in', qcmpt_ajax.is_user_logged_in );
    data.append( 'is_single', qcmpt_ajax.is_single );
    data.append( 'name', name);
    data.append( 'post_id', post_id);

    const connect = await fetch(route, {
        method: 'POST',
        credentials: 'same-origin',
        body: data
    })
    .then((response) => response.json())
    .then((data) => results = data)
    .catch((error) => {
        console.log('qcmptGetAcfField Function');
        console.error(error);
    });
    
    results = await connect;

    return results;
};
export const getTitleById = async (post_id) => {
    let route = '/wp-admin/admin-ajax.php',
        data = new URLSearchParams(),
        results;

    data.append('action', 'qcmptGetTitleById');
    data.append( 'nonce', qcmpt_ajax.nonce );
    data.append( 'is_user_logged_in', qcmpt_ajax.is_user_logged_in );
    data.append( 'is_single', qcmpt_ajax.is_single );
    data.append( 'post_id', post_id);

    const connect = await fetch(route, {
        method: 'POST',
        credentials: 'same-origin',
        body: data
    })
    .then((response) => response.json())
    .then((data) => results = data)
    .catch((error) => {
        console.log('qcmptGetTitleById Function');
        console.error(error);
    });
    
    results = await connect;

    return results;
};