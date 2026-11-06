/* MD5 untuk login HTTP-CHAP. Menyediakan hexMD5(string). */
function md5(str) {
  var S = [7,12,17,22,7,12,17,22,7,12,17,22,7,12,17,22,
           5,9,14,20,5,9,14,20,5,9,14,20,5,9,14,20,
           4,11,16,23,4,11,16,23,4,11,16,23,4,11,16,23,
           6,10,15,21,6,10,15,21,6,10,15,21,6,10,15,21];
  var K = [], i, j;
  for (i = 0; i < 64; i++) { K[i] = Math.floor(Math.abs(Math.sin(i + 1)) * 4294967296) | 0; }
  var len = str.length;
  var words = (((len + 8) >>> 6) + 1) * 16;
  var w = [];
  for (i = 0; i < words; i++) { w[i] = 0; }
  for (i = 0; i < len; i++) { w[i >> 2] |= (str.charCodeAt(i) & 255) << ((i % 4) * 8); }
  w[len >> 2] |= 128 << ((len % 4) * 8);
  w[words - 2] = len << 3;
  w[words - 1] = len >>> 29;
  var a0 = 0x67452301, b0 = 0xefcdab89 | 0, c0 = 0x98badcfe | 0, d0 = 0x10325476;
  for (var off = 0; off < words; off += 16) {
    var A = a0, B = b0, C = c0, D = d0, F, g;
    for (i = 0; i < 64; i++) {
      if (i < 16) { F = (B & C) | (~B & D); g = i; }
      else if (i < 32) { F = (D & B) | (~D & C); g = (5 * i + 1) % 16; }
      else if (i < 48) { F = B ^ C ^ D; g = (3 * i + 5) % 16; }
      else { F = C ^ (B | ~D); g = (7 * i) % 16; }
      F = (F + A + K[i] + w[off + g]) | 0;
      A = D; D = C; C = B;
      B = (B + ((F << S[i]) | (F >>> (32 - S[i])))) | 0;
    }
    a0 = (a0 + A) | 0; b0 = (b0 + B) | 0; c0 = (c0 + C) | 0; d0 = (d0 + D) | 0;
  }
  var out = '', v = [a0, b0, c0, d0], b;
  for (i = 0; i < 4; i++) {
    for (j = 0; j < 4; j++) {
      b = (v[i] >>> (j * 8)) & 255;
      out += (b < 16 ? '0' : '') + b.toString(16);
    }
  }
  return out;
}

function hexMD5(s) { return md5(s); }
