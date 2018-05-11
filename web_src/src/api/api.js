import axios from '../http'

const test = async() => {
  await axios.get('127.0.0.11/api/user/register')
}

export default test
