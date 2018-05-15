import axios from '../http'

export const getItems = async() => {
  let data = await axios.post('/api/items')
  return data
}

export const getItemMembers = async (id) => {
  let data = await axios.get('/api/member/' + id)
  return data
}
