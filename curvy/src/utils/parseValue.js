export const parseValue = (value) => {
	if (value.indexOf("var:") === 0) {
		// var:preset|spacing|40
		const varValue = value.split(":")[1].split("|").join("--");
		// preset--spacing--40
		return `var(--wp--${varValue})`;
	}
	return value;
};
