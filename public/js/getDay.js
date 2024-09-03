export function getWeekends({startDate, endDate}){
    const weeekends = []
    let currentDate = dayjs(startDate)
    const end = dayjs(endDate)

    while(currentDate.isBefore(end) || currentDate.isSame(end, 'day')){
        if(currentDate.day() === 0 || currentDate.day() === 6){
            weeekends.push(currentDate.toDate())
        }
        currentDate = currentDate.add(1, 'day')
    }
    return weeekends
}