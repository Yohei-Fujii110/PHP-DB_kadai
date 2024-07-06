console.log('これでどうだ');

const areaBtn = document.getElementById('area-btn');
const infoBtn = document.getElementById('info-btn');
const table = document.getElementById('table');
const title = document.getElementById('title');

// HTML初期化
let html = '';

// イベント実行
document.addEventListener('DOMContentLoaded', () => {
  weatherData()
});
areaBtn.addEventListener('click', (e) => {
  e.preventDefault();
  weatherData()
});
infoBtn.addEventListener('click', (e) => {
  e.preventDefault();
  memberData();
});

// クッキー取得
const getCookie = (email) => {
  const cookies = document.cookie.split(';');
  for (let i = 0; i < cookies.length; i++) {
    const [cookieName, value] = cookies[i].trim().split('=');

    if (cookieName === email) {
      return decodeURIComponent(value);
    }
  }
}

// --- 会員情報表示------------------------------------
function memberData() {
  // HTML初期化
  html = '';

  // 見出し
  title.textContent = '会員情報一覧';

  const disData = {
    email: getCookie('email'),
  };
  console.log(disData);

  // サーバー側にAjaxリクエストを送信
  fetch('ajax_server.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(disData) // JSON形式に変換
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json(); // オブジェクト形式に変換
  }) 
  .then(data => {
    // 個人情報表示
    for( let key in data ) {
      if(key === 'password') {
        continue;
      }
      html += `<div>${key}</div><div>${data[key]}</div>`;
    }

    // HTML書き込み
    table.innerHTML = html;
  })
  .catch(error => {
    console.error('Error fetching data:', error);
    html += `<div>${error.message}</div><div>どういうことだと思う？</div>`;
    table.innerHTML = html;
  });
}
// --- 会員情報表示------------------------------------

// --- 地域天気表示------------------------------------
function weatherData() {
  // HTML初期化
  html = '';

  // 各情報
  const apiKey = 'ddbaf08feecb56297fd2f5b525d4ac47';
  const url = `https://api.openweathermap.org/data/2.5/weather?q=${encodeURIComponent(address)}&appid=${apiKey}&lang=ja&units=metric`;

  // 見出し
  title.textContent = `${address}の天気予報`;

  // サーバー側がらAjaxリクエストを受信
  fetch(url)
  .then(res => res.json()) // オブジェクト形式に変換
  .then(data => {
    const weatherArr = data.weather;
    const weather = weatherArr[0]['main'];
    const icon = `<img src="https://openweathermap.org/img/wn/${weatherArr[0]['icon']}@2x.png">`;
    const temp = `${Math.round(data.main.temp)} ℃`;
    const wind =`${data.wind.speed} (m/s)` ;

    html += `<div>天気</div><div>${weather}</div>`;
    html += `<div>アイコン</div><div>${icon}</div>`;
    html += `<div>気温</div><div>${temp}</div>`;
    html += `<div>風速</div><div>${wind}</div>`;

    // HTML書き込み
    table.innerHTML = html;
  })
  .catch(error => {
    html += `<div>${error}</div><div>天気情報取得に失敗しました</div>`;
    table.innerHTML = html;
  });
  table.innerHTML = html;
}
// --- 地域天気表示------------------------------------