const date = $('#date');

function main(){
    dateZone()
}

function dateZone(){
    const now = dayjs().locale('es')
    const format = 'DD/MM/YYYY'
    const nowFormat = now.format(format)

    date.html(nowFormat)
}


document.addEventListener('DOMContentLoaded', main)
