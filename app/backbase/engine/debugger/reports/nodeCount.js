( {
	'init': function(){

	},

	'report': function(){
		var oReport, a = ['<table cellpadding="0" cellspacing="0" class="bb-debugger-table">'];

		a.push('<thead><tr><th colspan="2">System information</th></tr></thead>');
		a.push('<tbody>')
		a.push('<tr><td class="bb-debugger-first">Engine version</td><td>'+bb.version+'</td></tr>');
		a.push('</tbody>');

		a.push('<thead><tr><th colspan="2">Model space summary</th></tr></thead>');


		oReport = [{i:0}, {i:0, tags:{}}, {i:0}, {i:0}, {i:0}, {i:0}, {i:0}, {i:0}, {i:0}, {i:0},
						  {i:0}, {i:0}, {i:0}, {i:0}];
		this.countAll(bb.tooling.window.bb.document.modelNode, oReport);
		a.push('<tbody>')
		a.push('<tr><td class="bb-debugger-first">Total text-nodes</td><td>'+oReport[3].i+'</td></tr>');
		a.push('<tr><td class="bb-debugger-first">Total element-nodes</td><td>'+oReport[1].i+'</td></tr>');
		a.push('</tbody>');
		a.push('<thead><tr><th colspan="2">Model space details</th></tr></thead>');
		a.push('<tbody>')
		for (var i in oReport[1].tags) {
			if( oReport[1].tags.hasOwnProperty( i ) )
				a.push('<tr><td class="bb-debugger-first">'+i+'</td><td>'+oReport[1].tags[i]+'</td></tr>');
		}
		a.push('</tbody>');


		a.push('</table>');

		return a.join('');
	},

	'countAllChildren': function (oXml, oReport) {
		for(var i=0, l=oXml.childNodes.length;i<l;i++) {
			this.countAll(oXml.childNodes[i], oReport);
		}
	},

	'countAll': function (oXml, oReport) {
		switch (oXml.nodeType) {
			case 1:    // ELEMENT_NODE
				oReport[oXml.nodeType].i++;
				var sName = oXml.tagName || oXml.localName || oXml.baseName;
				if( !oReport[oXml.nodeType].tags[sName] )
					oReport[oXml.nodeType].tags[sName] = 0;
				oReport[oXml.nodeType].tags[sName]++;
				this.countAllChildren(oXml, oReport);
				break;
			case 2:    // ATTRIBUTE_NODE
				break;
			case 3:    // TEXT_NODE
				oReport[oXml.nodeType].i++;
				break;
			case 4:    // CDATA_SECTION_NODE
				break;
			case 5:    // ENTITY_REFERENCE_NODE
				break;
			case 6:    // ENTITY_NODE
				break;
			case 7:    // PROCESSING_INSTRUCTION_NODE
				break;
			case 8:    // COMMENT_NODE
				break;
			case 9:    // DOCUMENT_NODE
				oReport[oXml.nodeType].i++;
				this.countAllChildren(oXml, oReport);
				break;
			case 10:    // DOCUMENT_TYPE_NODE
				break;
			case 11:    // DOCUMENT_FRAGMENT_NODE
				break;
			case 12:    // NOTATION_NODE
				break;
			case 13:    // XPATH_NAMESPACE_NODE
				break;
		}
	}
} )