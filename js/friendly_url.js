function friendly_url(str,max) {
  if (max === undefined) max = 64;
  var a_chars = new Array(
	new Array("a",/[áàâãªÁÀÂÃ]/g),
	new Array("e",/[éèêÉÈÊ]/g),
	new Array("i",/[íìîÍÌÎ]/g),
	new Array("o",/[òóôõºÓÒÔÕ]/g),
	new Array("u",/[úùûÚÙÛ]/g),
	new Array("c",/[çÇ]/g),
	new Array("n",/[Ññ]/g)
  );
  // Replace vowel with accent without them
  for(var i=0;i<a_chars.length;i++)
    str = str.replace(a_chars[i][1],a_chars[i][0]);
  // first replace whitespace by -, second remove repeated - by just one,
  // third turn in low case the chars,
  // fourth delete all chars which are not between a-z or 0-9, fifth trim the string and
  // the last step truncate the string to 64 chars 
  return str.replace(/\s+/g,'-').toLowerCase().replace(/[^a-z0-9\-]/g, '').replace(/\-{2,}/g,'-').replace(/(^\s*)|(\s*$)/g, '').substr(0,max);
}
