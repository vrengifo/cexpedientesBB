bb._y_[bb.cg_]={};bb._y_[bb.cg_]['schema']=function(a){var h_=a._v_,R_=h_.getAttribute('targetNamespace');if(R_){var b=bb.cX_[R_];if(!b){b=bb.hb_(R_,h_.getAttribute('version'));bb.cX_[R_]=b;}bb.aj_(h_,bb.A_['schema'],b,a);}};bb.A_={};bb.A_['schema']={};bb.A_['schema']['import']=function(h_,a){};bb.A_['schema']['annotation']=function(h_,a){};bb.A_['schema']['simpleType']=function(h_,a){var a_=h_.getAttribute('name');if(a_){var b=bb.cV_(a_,a);a.X_[a_]=b;bb.aj_(h_,bb.A_['simpleType'],b);}};bb.A_['simpleType']={};bb.A_['simpleType']['list']=function(h_,a){a.bu_=3;a.a2_=3;var b=h_.getAttribute('itemType'),c=b?bb.aq_(h_,b)[0]:null;a.k3_=c?c[0]:null;a.k4_=c?c[1]:null;bb.aj_(h_,bb.A_['list'],a);};bb.A_['simpleType']['union']=function(h_,a){a.bu_=4;a.a2_=4;var b=h_.getAttribute('memberTypes'),c=b?bb.aq_(h_,b):[];a.ch_=[];for(var d=0;d<c.length;d++){a.ch_.push([c[d][0],c[d][1]]);}bb.aj_(h_,bb.A_['union'],a);};bb.A_['union']={};bb.A_['union']['simpleType']=function(h_,_a_){var a=bb.cV_(null,_a_.cW_);_a_.ch_.push(a);bb.aj_(h_,bb.A_['simpleType'],a);};bb.A_['list']={};bb.A_['list']['simpleType']=function(h_,_a_){var a=bb.cV_(null,_a_.cW_);_a_.bv_=a;bb.aj_(h_,bb.A_['simpleType'],a);};bb.A_['simpleType']['restriction']=function(h_,a){var b=h_.getAttribute('base'),c=b?bb.aq_(h_,b)[0]:null;a.bu_=2;if(c){a.k0_=c[0];a.k1_=c[1];}bb.aj_(h_,bb.A_['restriction'],a);};bb.A_['restriction']={};bb.A_['restriction']['simpleType']=function(h_,_a_){var a=bb.cV_(null,_a_.cW_);_a_._a_=a;bb.aj_(h_,bb.A_['simpleType'],a);};bb.A_['restriction']['enumeration']=function(h_,_a_){_a_.fn_.push(h_.getAttribute('value'));};bb.A_['enumeration']={};bb.A_['restriction']['fractionDigits']=bb.A_['restriction']['length']=bb.A_['restriction']['maxExclusive']=bb.A_['restriction']['maxInclusive']=bb.A_['restriction']['maxLength']=bb.A_['restriction']['minExclusive']=bb.A_['restriction']['minInclusive']=bb.A_['restriction']['minLength']=bb.A_['restriction']['totalDigits']=function(h_,_a_){var a=bb.fo_(h_.localName||h_.baseName,h_.getAttribute('value'),h_.getAttribute('fixed')=='true');_a_._l_.push(a);};bb.A_['fractionDigits']={};bb.A_['length']={};bb.A_['maxExclusive']={};bb.A_['maxInclusive']={};bb.A_['maxLength']={};bb.A_['minExclusive']={};bb.A_['minInclusive']={};bb.A_['minLength']={};bb.A_['totalDigits']={};bb.A_['restriction']['pattern']=function(h_,_a_){var a=bb.h__(h_.getAttribute('value'));_a_._l_.push(a);};bb.A_['pattern']={};bb.A_['restriction']['whiteSpace']=function(h_,_a_){var a=bb.fo_(h_.localName||h_.baseName,h_.getAttribute('value'),h_.getAttribute('fixed')=='true');_a_.bc_=a;};bb.A_['whiteSpace']={};bb.A_['simpleType']['annotation']=bb.A_['list']['annotation']=bb.A_['union']['annotation']=bb.A_['restriction']['annotation']=bb.A_['enumeration']['annotation']=bb.A_['fractionDigits']['annotation']=bb.A_['maxExclusive']['annotation']=bb.A_['maxInclusive']['annotation']=bb.A_['maxLength']['annotation']=bb.A_['minExclusive']['annotation']=bb.A_['minInclusive']['annotation']=bb.A_['minLength']['annotation']=bb.A_['pattern']['annotation']=bb.A_['totalDigits']['annotation']=bb.A_['whiteSpace']['annotation']=function(h_,a){};