import{d as A,a as t,i as S,c as P,u as i,h as T,w as a,o as k,f as I,t as l,e as n,g as B,F as L,j as W,r as G}from"./app-DxEMjA1o.js";import{_ as H}from"./AppLayout.vue_vue_type_script_setup_true_lang-CVYWbZBl.js";import{G as V}from"./GridLayout-B4n6cH4H.js";import{g as j,m as Y,_ as C,r as O,w as U,u as X,f as J,a as R}from"./zoom-CaayyvFY.js";import{D as y,a as s,M as K}from"./index-BEmSjBoC.js";import{B as Q}from"./TextArea-uNcEafKx.js";import{E as Z}from"./eye-DvUx8blh.js";import{T as ee}from"./index-C1NOuGaX.js";import{_ as te}from"./_plugin-vue_export-helper-DlAUqK2U.js";import"./_commonjsHelpers-DsqdWQfm.js";import"./AppLogoIcon.vue_vue_type_script_setup_true_lang-3T_bTz1G.js";import"./index-DtfSEgky.js";import"./VisuallyHidden-D2yZqK94.js";import"./useForwardExpose-CyY1uY0y.js";import"./useForwardPropsEmits-DkQNHbA4.js";import"./index-Ca24ksus.js";import"./createLucideIcon-I05OgPX5.js";import"./index-DiGbMxEd.js";import"./Col-5htU6lVa.js";import"./useMergedState-ax9UAIkM.js";import"./css-NT62W356.js";import"./useState-paSx_tBI.js";import"./index-Dvf6h6ie.js";import"./index-Dp5ucu3C.js";import"./EyeOutlined-BhXDx8DS.js";import"./CloseOutlined-AyX-MFA2.js";import"./InfoCircleFilled-DU-1wMzk.js";import"./FormItemContext-DgaERsWL.js";import"./index-CAiWNdbp.js";import"./collapseMotion-CNqGbOrj.js";import"./LeftOutlined-D5sAQWbZ.js";import"./index-C_yJ-fZH.js";import"./index-Dz7bamcW.js";import"./index-U5qY8StY.js";const ae=d=>{const{componentCls:f,sizePaddingEdgeHorizontal:v,colorSplit:b,lineWidth:p}=d;return{[f]:C(C({},O(d)),{borderBlockStart:`${p}px solid ${b}`,"&-vertical":{position:"relative",top:"-0.06em",display:"inline-block",height:"0.9em",margin:`0 ${d.dividerVerticalGutterMargin}px`,verticalAlign:"middle",borderTop:0,borderInlineStart:`${p}px solid ${b}`},"&-horizontal":{display:"flex",clear:"both",width:"100%",minWidth:"100%",margin:`${d.dividerHorizontalGutterMargin}px 0`},[`&-horizontal${f}-with-text`]:{display:"flex",alignItems:"center",margin:`${d.dividerHorizontalWithTextGutterMargin}px 0`,color:d.colorTextHeading,fontWeight:500,fontSize:d.fontSizeLG,whiteSpace:"nowrap",textAlign:"center",borderBlockStart:`0 ${b}`,"&::before, &::after":{position:"relative",width:"50%",borderBlockStart:`${p}px solid transparent`,borderBlockStartColor:"inherit",borderBlockEnd:0,transform:"translateY(50%)",content:"''"}},[`&-horizontal${f}-with-text-left`]:{"&::before":{width:"5%"},"&::after":{width:"95%"}},[`&-horizontal${f}-with-text-right`]:{"&::before":{width:"95%"},"&::after":{width:"5%"}},[`${f}-inner-text`]:{display:"inline-block",padding:"0 1em"},"&-dashed":{background:"none",borderColor:b,borderStyle:"dashed",borderWidth:`${p}px 0 0`},[`&-horizontal${f}-with-text${f}-dashed`]:{"&::before, &::after":{borderStyle:"dashed none none"}},[`&-vertical${f}-dashed`]:{borderInlineStartWidth:p,borderInlineEnd:0,borderBlockStart:0,borderBlockEnd:0},[`&-plain${f}-with-text`]:{color:d.colorText,fontWeight:"normal",fontSize:d.fontSize},[`&-horizontal${f}-with-text-left${f}-no-default-orientation-margin-left`]:{"&::before":{width:0},"&::after":{width:"100%"},[`${f}-inner-text`]:{paddingInlineStart:v}},[`&-horizontal${f}-with-text-right${f}-no-default-orientation-margin-right`]:{"&::before":{width:"100%"},"&::after":{width:0},[`${f}-inner-text`]:{paddingInlineEnd:v}}})}},ie=j("Divider",d=>{const f=Y(d,{dividerVerticalGutterMargin:d.marginXS,dividerHorizontalWithTextGutterMargin:d.margin,dividerHorizontalGutterMargin:d.marginLG});return[ae(f)]},{sizePaddingEdgeHorizontal:0}),re=()=>({prefixCls:String,type:{type:String,default:"horizontal"},dashed:{type:Boolean,default:!1},orientation:{type:String,default:"center"},plain:{type:Boolean,default:!1},orientationMargin:[String,Number]}),oe=A({name:"ADivider",inheritAttrs:!1,compatConfig:{MODE:3},props:re(),setup(d,f){let{slots:v,attrs:b}=f;const{prefixCls:p,direction:o}=X("divider",d),[N,g]=ie(p),w=S(()=>d.orientation==="left"&&d.orientationMargin!=null),z=S(()=>d.orientation==="right"&&d.orientationMargin!=null),r=S(()=>{const{type:c,dashed:u,plain:h}=d,_=p.value;return{[_]:!0,[g.value]:!!g.value,[`${_}-${c}`]:!0,[`${_}-dashed`]:!!u,[`${_}-plain`]:!!h,[`${_}-rtl`]:o.value==="rtl",[`${_}-no-default-orientation-margin-left`]:w.value,[`${_}-no-default-orientation-margin-right`]:z.value}}),e=S(()=>{const c=typeof d.orientationMargin=="number"?`${d.orientationMargin}px`:d.orientationMargin;return C(C({},w.value&&{marginLeft:c}),z.value&&{marginRight:c})}),m=S(()=>d.orientation.length>0?"-"+d.orientation:d.orientation);return()=>{var c;const u=J((c=v.default)===null||c===void 0?void 0:c.call(v));return N(t("div",R(R({},b),{},{class:[r.value,u.length?`${p.value}-with-text ${p.value}-with-text${m.value}`:"",b.class],role:"separator"}),[u.length?t("span",{class:`${p.value}-inner-text`,style:e.value},[u]):null]))}}}),x=U(oe),ne={style:{display:"flex","justify-content":"flex-end",gap:"8px"}},le={key:0,class:"modal-body"},se={id:"inquiry-print-area"},de={style:{"margin-bottom":"16px"}},fe={style:{color:"#999","font-size":"12px","margin-left":"8px"}},pe=["onClick"],me=A({__name:"List",props:{inquiries:{}},setup(d){const f=d,v=[{title:"First Name",dataIndex:"first_name",key:"first_name"},{title:"Last Name",dataIndex:"last_name",key:"last_name"},{title:"Service Applied For",dataIndex:"service_applying_for",key:"service_applying_for"},{title:"Email",dataIndex:"email",key:"email"},{title:"Phone",dataIndex:"phone",key:"phone"},{title:"Action",dataIndex:"action",key:"action",width:"100px"}],b=S(()=>({current:f.inquiries.current_page,pageSize:f.inquiries.per_page,total:f.inquiries.total,showSizeChanger:!0,onChange:(r,e)=>{W.get("/admin/inquiries",{page:r,per_page:e},{preserveState:!0,preserveScroll:!0})}})),p=[{title:"Home",href:"/admin/dashboard"},{title:"Inquiries"}],o=G({visible:!1,data:null}),N=r=>{o.data=r,o.visible=!0},g=r=>r?new Date(r).toLocaleDateString("en-US",{year:"numeric",month:"long",day:"numeric"}):"—",w=r=>r==null?"—":r?"Yes":"No",z=()=>{if(!o.data)return;const r=o.data,e=(h,_=!1)=>{if(h==null||h==="")return'<span style="color:#aaa;">—</span>';if(typeof h=="boolean")return h?"Yes":"No";const $=String(h);return _?$.charAt(0).toUpperCase()+$.slice(1):$},m=(h,_,$)=>{const q=$.map(([M,D,E,F])=>E!==void 0?`<tr><th>${M}</th><td>${D}</td><th>${E}</th><td>${F}</td></tr>`:`<tr><th colspan="1">${M}</th><td colspan="3">${D}</td></tr>`).join("");return`
            <div class="section">
                <div class="section-title">${h} ${_}</div>
                <table>
                    <tbody>${q}</tbody>
                </table>
            </div>
        `},c=`
        <!DOCTYPE html>
        <html>
        <head>
            <title>Inquiry Details — ${r.first_name} ${r.last_name}</title>
            <style>
                * { box-sizing: border-box; margin: 0; padding: 0; }
                body {
                    font-family: Arial, sans-serif;
                    font-size: 12px;
                    color: #222;
                    padding: 28px 32px;
                    line-height: 1.5;
                }
                .header { margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 12px; }
                .header h1 { font-size: 20px; margin-bottom: 6px; }
                .header .meta { font-size: 11px; color: #666; margin-top: 4px; }
                .status-badge {
                    display: inline-block;
                    padding: 2px 12px;
                    border-radius: 12px;
                    font-size: 11px;
                    font-weight: 700;
                    text-transform: capitalize;
                }
                .section { margin-bottom: 18px; page-break-inside: avoid; }
                .section-title {
                    font-size: 12px;
                    font-weight: 700;
                    color: #444;
                    background: #f0f0f0;
                    padding: 5px 10px;
                    margin-bottom: 0;
                    border: 1px solid #ddd;
                    border-bottom: none;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    border: 1px solid #ddd;
                    padding: 6px 10px;
                    vertical-align: top;
                    word-break: break-word;
                    overflow-wrap: break-word;
                }
                th {
                    background: #fafafa;
                    font-weight: 600;
                    width: 22%;
                    color: #555;
                    white-space: nowrap;
                }
                td {
                    width: 28%;
                }
                @page { margin: 15mm; }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>Inquiry Details</h1>
                <span class="status-badge">${r.status}</span>
                <div class="meta">Submitted: ${g(r.created_at)} &nbsp;|&nbsp; ID: #${r.id}</div>
            </div>

            ${m("👤","Personal Information",[["First Name",e(r.first_name),"Last Name",e(r.last_name)],["Sex",e(r.sex,!0),"Date of Birth",e(g(r.dob))],["Email",e(r.email),"Phone",e(r.phone)],["Name Ever Changed",e(r.name_changed),"City & State of Birth",e(r.birth_city_state)],["Service Applying For",e(r.service_applying_for,!0),"",""]])}

            ${m("🏠","Residence Information",[["Country of Residence",e(r.country_residence,!0),"State of Residence",e(r.state_residence,!0)],["Profession",e(r.profession),"Work Address",e(r.work_address)]])}

            ${m("❤️","Marital Status",[["Marital Status",e(r.marital_status,!0),"Spouse Name",e(r.spouse_name)],["Spouse Profession",e(r.spouse_profession),"Spouse Nationality",e(r.spouse_nationality)],["Spouse Date of Birth",e(g(r.spouse_dob)),"",""]])}

            ${m("👨‍👩‍👧","Parents Information",[["Father's Name",e(r.father_name),"Mother's Name",e(r.mother_name)],["Father's Profession",e(r.father_profession),"Mother's Profession",e(r.mother_profession)],["Father's Nationality",e(r.father_nationality),"Mother's Nationality",e(r.mother_nationality)]])}

            ${m("✈️","Travel Information",[["Port of Entry in India",e(r.port_entry_india),"Port of Exit in India",e(r.port_exit_india)]])}

            ${m("📍","Reference in India",[["Reference Name",e(r.reference_name_india),"Reference Phone",e(r.reference_phone_india)],["Reference Address",e(r.reference_address_india),"Police Station",e(r.police_station_india)]])}

            ${m("🚨","Emergency Contact",[["Contact Person",e(r.emergency_contact_person),"Contact Number",e(r.emergency_contact_number)]])}

            ${m("💼","Sponsor Details",[["Sponsor Name",e(r.sponsor_name),"Sponsor Address",e(r.sponsor_address)]])}
        </body>
        </html>
    `,u=window.open("","_blank","width=960,height=800");u&&(u.document.write(c),u.document.close(),u.focus(),setTimeout(()=>{u.print(),u.close()},400))};return(r,e)=>(k(),P(L,null,[t(i(T),{title:"Inquiries"}),t(i(K),{open:o.visible,title:"Inquiry Details",width:"1000px",onCancel:e[0]||(e[0]=m=>o.visible=!1)},{footer:a(()=>[I("div",ne,[t(i(Q),{type:"primary",onClick:z},{default:a(()=>[...e[1]||(e[1]=[n(" Print ",-1)])]),_:1})])]),default:a(()=>[o.data?(k(),P("div",le,[I("div",se,[I("div",de,[I("span",fe," Submitted: "+l(g(o.data.created_at)),1)]),t(i(x),{orientation:"left"},{default:a(()=>[...e[2]||(e[2]=[n("👤 Personal Information",-1)])]),_:1}),t(i(y),{bordered:"",column:2,size:"small"},{default:a(()=>[t(i(s),{label:"First Name"},{default:a(()=>[n(l(o.data.first_name||"—"),1)]),_:1}),t(i(s),{label:"Last Name"},{default:a(()=>[n(l(o.data.last_name||"—"),1)]),_:1}),t(i(s),{label:"Sex",style:{"text-transform":"capitalize"}},{default:a(()=>[n(l(o.data.sex||"—"),1)]),_:1}),t(i(s),{label:"Date of Birth"},{default:a(()=>[n(l(g(o.data.dob)),1)]),_:1}),t(i(s),{label:"Email"},{default:a(()=>[n(l(o.data.email||"—"),1)]),_:1}),t(i(s),{label:"Phone"},{default:a(()=>[n(l(o.data.phone||"—"),1)]),_:1}),t(i(s),{label:"Name Ever Changed"},{default:a(()=>[n(l(w(o.data.name_changed)),1)]),_:1}),t(i(s),{label:"City & State of Birth"},{default:a(()=>[n(l(o.data.birth_city_state||"—"),1)]),_:1}),t(i(s),{label:"Service Applying For",span:2},{default:a(()=>[n(l(o.data.service_applying_for||"—"),1)]),_:1})]),_:1}),t(i(x),{orientation:"left"},{default:a(()=>[...e[3]||(e[3]=[n("🏠 Residence Information",-1)])]),_:1}),t(i(y),{bordered:"",column:2,size:"small"},{default:a(()=>[t(i(s),{label:"Country of Residence"},{default:a(()=>[n(l(o.data.country_residence||"—"),1)]),_:1}),t(i(s),{label:"State of Residence"},{default:a(()=>[n(l(o.data.state_residence||"—"),1)]),_:1}),t(i(s),{label:"Profession"},{default:a(()=>[n(l(o.data.profession||"—"),1)]),_:1}),t(i(s),{label:"Work Address"},{default:a(()=>[n(l(o.data.work_address||"—"),1)]),_:1})]),_:1}),t(i(x),{orientation:"left"},{default:a(()=>[...e[4]||(e[4]=[n("❤️ Marital Status",-1)])]),_:1}),t(i(y),{bordered:"",column:2,size:"small"},{default:a(()=>[t(i(s),{label:"Marital Status",style:{"text-transform":"capitalize"}},{default:a(()=>[n(l(o.data.marital_status||"—"),1)]),_:1}),t(i(s),{label:"Spouse Name"},{default:a(()=>[n(l(o.data.spouse_name||"—"),1)]),_:1}),t(i(s),{label:"Spouse Profession"},{default:a(()=>[n(l(o.data.spouse_profession||"—"),1)]),_:1}),t(i(s),{label:"Spouse Nationality"},{default:a(()=>[n(l(o.data.spouse_nationality||"—"),1)]),_:1}),t(i(s),{label:"Spouse Date of Birth",span:2},{default:a(()=>[n(l(g(o.data.spouse_dob)),1)]),_:1})]),_:1}),t(i(x),{orientation:"left"},{default:a(()=>[...e[5]||(e[5]=[n("👨‍👩‍👧 Parents Information",-1)])]),_:1}),t(i(y),{bordered:"",column:2,size:"small"},{default:a(()=>[t(i(s),{label:"Father's Name"},{default:a(()=>[n(l(o.data.father_name||"—"),1)]),_:1}),t(i(s),{label:"Mother's Name"},{default:a(()=>[n(l(o.data.mother_name||"—"),1)]),_:1}),t(i(s),{label:"Father's Profession"},{default:a(()=>[n(l(o.data.father_profession||"—"),1)]),_:1}),t(i(s),{label:"Mother's Profession"},{default:a(()=>[n(l(o.data.mother_profession||"—"),1)]),_:1}),t(i(s),{label:"Father's Nationality"},{default:a(()=>[n(l(o.data.father_nationality||"—"),1)]),_:1}),t(i(s),{label:"Mother's Nationality"},{default:a(()=>[n(l(o.data.mother_nationality||"—"),1)]),_:1})]),_:1}),t(i(x),{orientation:"left"},{default:a(()=>[...e[6]||(e[6]=[n("✈️ Travel Information",-1)])]),_:1}),t(i(y),{bordered:"",column:2,size:"small"},{default:a(()=>[t(i(s),{label:"Port of Entry in India"},{default:a(()=>[n(l(o.data.port_entry_india||"—"),1)]),_:1}),t(i(s),{label:"Port of Exit in India"},{default:a(()=>[n(l(o.data.port_exit_india||"—"),1)]),_:1})]),_:1}),t(i(x),{orientation:"left"},{default:a(()=>[...e[7]||(e[7]=[n("📍 Reference in India",-1)])]),_:1}),t(i(y),{bordered:"",column:2,size:"small"},{default:a(()=>[t(i(s),{label:"Reference Name"},{default:a(()=>[n(l(o.data.reference_name_india||"—"),1)]),_:1}),t(i(s),{label:"Reference Phone"},{default:a(()=>[n(l(o.data.reference_phone_india||"—"),1)]),_:1}),t(i(s),{label:"Reference Address",span:2},{default:a(()=>[n(l(o.data.reference_address_india||"—"),1)]),_:1}),t(i(s),{label:"Police Station",span:2},{default:a(()=>[n(l(o.data.police_station_india||"—"),1)]),_:1})]),_:1}),t(i(x),{orientation:"left"},{default:a(()=>[...e[8]||(e[8]=[n("🚨 Emergency Contact",-1)])]),_:1}),t(i(y),{bordered:"",column:2,size:"small"},{default:a(()=>[t(i(s),{label:"Contact Person"},{default:a(()=>[n(l(o.data.emergency_contact_person||"—"),1)]),_:1}),t(i(s),{label:"Contact Number"},{default:a(()=>[n(l(o.data.emergency_contact_number||"—"),1)]),_:1})]),_:1}),t(i(x),{orientation:"left"},{default:a(()=>[...e[9]||(e[9]=[n("💼 Sponsor Details",-1)])]),_:1}),t(i(y),{bordered:"",column:2,size:"small"},{default:a(()=>[t(i(s),{label:"Sponsor Name"},{default:a(()=>[n(l(o.data.sponsor_name||"—"),1)]),_:1}),t(i(s),{label:"Sponsor Address"},{default:a(()=>[n(l(o.data.sponsor_address||"—"),1)]),_:1})]),_:1})])])):B("",!0)]),_:1},8,["open"]),t(H,{breadcrumbs:p},{default:a(()=>[t(V,{title:"Inquiries"},{default:a(()=>[t(i(ee),{columns:v,"data-source":f.inquiries.data,pagination:b.value,"row-key":"id",bordered:""},{bodyCell:a(({column:m,record:c})=>[m.key==="action"?(k(),P("a",{key:0,href:"javascript:void(0)",onClick:u=>N(c)},[t(i(Z))],8,pe)):B("",!0)]),_:1},8,["data-source","pagination"])]),_:1})]),_:1})],64))}}),Oe=te(me,[["__scopeId","data-v-7489ec49"]]);export{Oe as default};
