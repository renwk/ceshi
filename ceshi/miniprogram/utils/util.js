const formatTime = date => {
  const year = date.getFullYear()
  const month = date.getMonth() + 1
  const day = date.getDate()
  const hour = date.getHours()
  const minute = date.getMinutes()
  const second = date.getSeconds()

  return [year, month, day].map(formatNumber).join('-')
}
const formatMonth = date => {
  const year = date.getFullYear()
  const month = date.getMonth() + 1

  return [year, month].map(formatNumber).join('-')
}

const formatNumber = n => {
  n = n.toString()
  return n[1] ? n : '0' + n
}
function showError(data){
  
}
module.exports = {
  formatTime: formatTime,
  formatMonth: formatMonth,
  showError: showError
}
