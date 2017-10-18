var checkPostcode = function (postcode) {
  if (String(postcode).match(/^[0-9]{3}\-[0-9]{4}$/) !== null) {
    console.log("正しい郵便番号です");
  } else {
    console.log("正しい郵便番号ではありません");
  }
};

var removeNumber = function (postcode) {
  console.log( 
    String(postcode).replace(/[1-9]+/g, "")
  );
};